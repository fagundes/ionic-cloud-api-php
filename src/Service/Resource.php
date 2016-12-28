<?php

namespace Ionic\Service;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ionic\Client;
use Ionic\Model;
use Ionic\Service;
use Ionic\Utils\UriTemplate;

/**
 * Implements the actual methods/resources of the discovered Ionic API using magic function
 * calling overloading (__call()), which on call will see if the method name (plus.activities.list)
 * is available in this service, and if so construct an apiHttpRequest representing it.
 */
class Resource
{
    // Valid query parameters that work, but don't appear in discovery.
    private $stackParameters = [
        'page'        => ['type' => 'string', 'location' => 'query'],
        'page_size'   => ['type' => 'string', 'location' => 'query'],
        'fields'      => ['type' => 'array', 'location' => 'query'],
    ];

    /** @var string $rootUrl */
    private $rootUrl;

    /** @var Client $client */
    private $client;

    /** @var string $serviceName */
    private $serviceName;

    /** @var string $servicePath */
    private $servicePath;

    /** @var string $resourceName */
    private $resourceName;

    /** @var array $methods */
    private $methods;

    public function __construct(Service $service, $serviceName, $resourceName, $resource)
    {
        $this->rootUrl      = $service->rootUrl;
        $this->client       = $service->getClient();
        $this->servicePath  = $service->servicePath;
        $this->serviceName  = $serviceName;
        $this->resourceName = $resourceName;
        $this->methods      = is_array($resource) && isset($resource['methods']) ?
            $resource['methods'] :
            [$resourceName => $resource];
    }

    /**
     * TODO: This function needs simplifying.
     * @param $name
     * @param $arguments
     * @param $expectedClass - optional, the expected class name
     * @return Response|Model|$expectedClass
     * @throws Exception
     */
    protected function call($name, $arguments, $expectedClass = null)
    {
        if (!isset($this->methods[$name])) {
            throw new Exception(
                "Unknown function: " .
                "{$this->serviceName}->{$this->resourceName}->{$name}()"
            );
        }
        $method     = $this->methods[$name];
        $parameters = $arguments[0];
        // postBody is a special case since it's not defined in the discovery
        // document as parameter, but we abuse the param entry for storing it.
        $postBody = null;
        if (isset($parameters['postBody'])) {
            if ($parameters['postBody'] instanceof Model) {
                // In the cases the post body is an existing object, we want
                // to use the smart method to create a simple object for
                // for JSONification.
                $parameters['postBody'] = $parameters['postBody']->toSimpleObject();
            } else if (is_object($parameters['postBody'])) {
                // If the post body is another kind of object, we will try and
                // wrangle it into a sensible format.
                $parameters['postBody'] =
                    $this->convertToArrayAndStripNulls($parameters['postBody']);
            }
            $postBody = (array)$parameters['postBody'];
            unset($parameters['postBody']);
        }
        // TODO: optParams here probably should have been
        // handled already - this may well be redundant code.
        if (isset($parameters['optParams'])) {
            $optParams = $parameters['optParams'];
            unset($parameters['optParams']);
            $parameters = array_merge($parameters, $optParams);
        }
        if (!isset($method['parameters'])) {
            $method['parameters'] = [];
        }
        $method['parameters'] = array_merge(
            $this->stackParameters,
            $method['parameters']
        );
        foreach ($parameters as $key => $val) {
            if ($key != 'postBody' && !isset($method['parameters'][$key])) {
                throw new Exception("($name) unknown parameter: '$key'");
            }
        }
        foreach ($method['parameters'] as $paramName => $paramSpec) {
            if (isset($paramSpec['required']) &&
                $paramSpec['required'] &&
                !isset($parameters[$paramName])
            ) {
                throw new Exception("($name) missing required param: '$paramName'");
            }
            if (isset($parameters[$paramName])) {
                $value                           = $parameters[$paramName];
                $parameters[$paramName]          = $paramSpec;
                $parameters[$paramName]['value'] = $value;
                unset($parameters[$paramName]['required']);
            } else {
                // Ensure we don't pass nulls.
                unset($parameters[$paramName]);
            }
        }

        // build the service uri
        $url = $this->createRequestUri(
            $method['path'],
            $parameters
        );
        // NOTE: because we're creating the request by hand,
        // and because the service has a rootUrl property
        // the "base_uri" of the Http Client is not accounted for
        $request = new Request(
            $method['httpMethod'],
            $url,
            ['content-type' => 'application/json'],
            $postBody ? json_encode($postBody) : ''
        );

        // if this is a media type, we will return the raw response
        // rather than using an expected class
        if (isset($parameters['alt']) && $parameters['alt']['value'] == 'media') {
            $expectedClass = null;
        }

        return $this->client->execute($request, $expectedClass);
    }

    protected function convertToArrayAndStripNulls($o)
    {
        $o = (array)$o;
        foreach ($o as $k => $v) {
            if ($v === null) {
                unset($o[$k]);
            } elseif (is_object($v) || is_array($v)) {
                $o[$k] = $this->convertToArrayAndStripNulls($o[$k]);
            }
        }
        return $o;
    }

    /**
     * Parse/expand request parameters and create a fully qualified
     * request uri.
     * @static
     * @param string $restPath
     * @param array $params
     * @return string $requestUrl
     */
    protected function createRequestUri($restPath, $params)
    {
        // code for leading slash
        $requestUrl = $this->servicePath . $restPath;
        if ($this->rootUrl) {
            if ('/' !== substr($this->rootUrl, -1) && '/' !== substr($requestUrl, 0, 1)) {
                $requestUrl = '/' . $requestUrl;
            }
            $requestUrl = $this->rootUrl . $requestUrl;
        }
        $uriTemplateVars = [];
        $queryVars       = [];
        foreach ($params as $paramName => $paramSpec) {
            if ($paramSpec['type'] == 'boolean') {
                $paramSpec['value'] = ($paramSpec['value']) ? 'true' : 'false';
            }
            if ($paramSpec['location'] == 'path') {
                $uriTemplateVars[$paramName] = $paramSpec['value'];
            } else if ($paramSpec['location'] == 'query') {
                if (isset($paramSpec['repeated']) && is_array($paramSpec['value'])) {
                    foreach ($paramSpec['value'] as $value) {
                        $queryVars[] = $paramName . '=' . rawurlencode(rawurldecode($value));
                    }
                } else {
                    $queryVars[] = $paramName . '=' . rawurlencode(rawurldecode($paramSpec['value']));
                }
            }
        }
        if (count($uriTemplateVars)) {
            $uriTemplateParser = new UriTemplate();
            $requestUrl        = $uriTemplateParser->parse($requestUrl, $uriTemplateVars);
        }
        if (count($queryVars)) {
            $requestUrl .= '?' . implode($queryVars, '&');
        }
        return $requestUrl;
    }
}