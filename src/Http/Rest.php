<?php

namespace Ionic\Http;

use Google\Auth\HttpHandler\HttpHandlerFactory;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Ionic\Service\Exception as ServiceException;

/**
 * This class implements the RESTful transport of apiServiceRequest()'s
 */
class Rest
{
    /**
     * Executes a Psr\Http\Message\RequestInterface and (if applicable) automatically retries
     * when errors occur.
     *
     * @param ClientInterface $client
     * @param RequestInterface $request
     * @param $expectedClass
     * @param $config
     * @param $retryMap
     *
     * @return array decoded result
     * @throws ServiceException on server side error (ie: not authenticated,
     *  invalid or malformed post body, invalid url)
     */
    public static function execute(
        ClientInterface $client,
        RequestInterface $request,
        $expectedClass = null,
        $config = [],
        $retryMap = null
    )
    {
        $runner = new \Ionic\Task\Runner(
            $config,
            sprintf('%s %s', $request->getMethod(), (string)$request->getUri()),
            [get_class(), 'doExecute'],
            [$client, $request, $expectedClass]
        );
        if (!is_null($retryMap)) {
            $runner->setRetryMap($retryMap);
        }
        return $runner->run();
    }

    /**
     * Executes a Psr\Http\Message\RequestInterface
     *
     * @param ClientInterface $client
     * @param RequestInterface $request
     * @param $expectedClass
     * @return array decoded result
     * @throws ServiceException on server side error (ie: not authenticated,
     *  invalid or malformed post body, invalid url)
     */
    public static function doExecute(ClientInterface $client, RequestInterface $request, $expectedClass = null)
    {
        try {
            $httpHandler = HttpHandlerFactory::build($client);
            $response    = $httpHandler($request);
        } catch (RequestException $e) {
            // if Guzzle throws an exception, catch it and handle the response
            if (!$e->hasResponse()) {
                throw $e;
            }
            $response = $e->getResponse();
            // specific checking for Guzzle 5: convert to PSR7 response
            if ($response instanceof ResponseInterface) {
                $response = new Response(
                    $response->getStatusCode(),
                    $response->getHeaders() ?: [],
                    $response->getBody(),
                    $response->getProtocolVersion(),
                    $response->getReasonPhrase()
                );
            }
        }
        return self::decodeHttpResponse($response, $request, $expectedClass);
    }

    /**
     * Decode an HTTP Response.
     * @static
     * @throws ServiceException
     * @param ResponseInterface $response The http response to be decoded.
     * @param RequestInterface $request
     * @param string $expectedClass
     * @return mixed|null
     */
    public static function decodeHttpResponse(
        ResponseInterface $response,
        RequestInterface $request = null,
        $expectedClass = null
    )
    {
//        echo '<pre>';
//        var_dump($response);
//        var_dump($request); die;
        $code = $response->getStatusCode();
        // retry strategy
        if ((intVal($code)) >= 400) {
            // if we errored out, it should be safe to grab the response body
            $body = (string)$response->getBody();
            // Check if we received errors, and add those to the Exception for convenience
            throw new ServiceException($body, $code, null, self::getResponseErrors($body));
        }
        // Ensure we only pull the entire body into memory if the request is not
        // of media type
        $body = self::decodeBody($response, $request);
        if ($expectedClass = self::determineExpectedClass($expectedClass, $request)) {
            $array = json_decode($body, true);

            $data = array_key_exists('data', $array) ? $array['data'] : $array;
            $meta = array_key_exists('meta', $array) ? $array['meta'] : [];

            return new $expectedClass($data, $meta);
        }
        return $response;
    }

    private static function decodeBody(ResponseInterface $response, RequestInterface $request = null)
    {
        if (self::isAltMedia($request)) {
            // don't decode the body, it's probably a really long string
            return '';
        }
        return (string)$response->getBody();
    }

    private static function determineExpectedClass($expectedClass, RequestInterface $request = null)
    {
        // "false" is used to explicitly prevent an expected class from being returned
        if (false === $expectedClass) {
            return null;
        }
        // if we don't have a request, we just use what's passed in
        if (is_null($request)) {
            return $expectedClass;
        }
        // return what we have in the request header if one was not supplied
        return $expectedClass ?: $request->getHeaderLine('X-Php-Expected-Class');
    }

    private static function getResponseErrors($body)
    {
        $json = json_decode($body, true);
        if (isset($json['error']['errors'])) {
            return $json['error']['errors'];
        }
        return null;
    }

    private static function isAltMedia(RequestInterface $request = null)
    {
        if ($request && $qs = $request->getUri()->getQuery()) {
            parse_str($qs, $query);
            if (isset($query['alt']) && $query['alt'] == 'media') {
                return true;
            }
        }
        return false;
    }
}