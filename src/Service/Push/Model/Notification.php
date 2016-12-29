<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

/**
 * Class Notification
 *
 * @property NotificationConfig config
 */
class Notification extends Model
{
    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var string
     */
    protected $configType = NotificationConfig::class;

    /**
     * @var string
     */
    protected $configDataType = '';

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
     * @return NotificationConfig
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param NotificationConfig $config
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
        $date = new \DateTime($this->created);
        $date->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        return $date;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created->format('Y-m-d\TH:i:s.uP');
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