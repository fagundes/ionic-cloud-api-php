<?php

namespace Ionic;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\RequestInterface;
use Ionic\Http\Rest;

class Client
{
    const API_BASE_PATH = 'https://api.ionic.io';

    const LIBVER = "0.x-dev";

    const USER_AGENT_SUFFIX = "ionic-push-php-api/";

    /**
     * @var \GuzzleHttp\ClientInterface $http
     */
    private $http;

    /**
     * Construct the Ionic Client.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge(
            [
                'application_name' => '',

                // Don't change these unless you're working against a special development
                // or testing environment.
                'base_path'        => self::API_BASE_PATH,

                // https://apps.ionic.io/app -> Select App -> Settings -> API Keys -> + New Token
                'api_token'        => '',

                // Task Runner retry configuration
                // @see Ionic\Task\Runner
                'retry'            => [],
            ],
            $config
        );
    }

    /**
     * Get a string containing the version of the library.
     *
     * @return string
     */
    public function getLibraryVersion()
    {
        return self::LIBVER;
    }


    public function setConfig($name, $value)
    {
        $this->config[$name] = $value;
    }

    public function getConfig($name, $default = null)
    {
        return isset($this->config[$name]) ? $this->config[$name] : $default;
    }

    /**
     * Set the application name, this is included in the User-Agent HTTP header.
     * @param string $applicationName
     */
    public function setApplicationName($applicationName)
    {
        $this->config['application_name'] = $applicationName;
    }

    /**
     * Set the api token, this is included in Authorization HTTP header.
     * @param string $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->config['api_token'] = $apiToken;
    }

    /**
     * Set the Http Client object
     * @param ClientInterface $http
     */
    public function setHttpClient(ClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @return ClientInterface implementation
     */
    public function getHttpClient()
    {
        if (is_null($this->http)) {
            $this->http = $this->createDefaultHttpClient();
        }
        return $this->http;
    }

    protected function createDefaultHttpClient()
    {
        $options = [
            'exceptions' => false,
            'headers'    => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $this->config['api_token']
            ]
        ];
        $version = ClientInterface::VERSION;
        if ('5' === $version[0]) {
            $options = [
                'base_url' => $this->config['base_path'],
                'defaults' => $options,
            ];
        } else {
            // guzzle 6
            $options['base_uri'] = $this->config['base_path'];
        }
        return new HttpClient($options);
    }

    /**
     * Helper method to execute deferred HTTP requests.
     *
     * @param $request \Psr\Http\Message\RequestInterface|\Ionic\Batch
     * @throws \Ionic\Exception
     * @return object of the type of the expected class or Psr\Http\Message\ResponseInterface.
     */
    public function execute(RequestInterface $request, $expectedClass = null)
    {
        $request = $request->withHeader(
            'User-Agent',
            $this->config['application_name']
            . " " . self::USER_AGENT_SUFFIX
            . $this->getLibraryVersion()
        );
        return Rest::execute($this->getHttpClient(), $request, $expectedClass, $this->config['retry']);
    }
}