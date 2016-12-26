<?php

namespace Ionic\Service\Notifications\Model;

use Ionic\Model;

class Notification extends Model
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * TODO implement this as a Model
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string
     */
    protected $app_id;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        if(is_string($this->created)) {
            $this->created = new \DateTime($this->created);
        }
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param string $app_id
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
    }

}