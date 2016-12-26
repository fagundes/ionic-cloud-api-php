<?php

namespace Ionic;

class Service
{
    public  $rootUrl;
    public  $version;
    public  $servicePath;
    public  $resource;
    public  $serviceName;
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Return the associated Ionic\Client class.
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}