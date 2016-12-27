<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

/**
 * Class NotificationConfig
 *
 * @property AndroidNotificationConfig android
 * @property IOSNotificationConfig ios
 */
class NotificationConfig extends Model
{
    /**
     * @var string
     */
    protected $androidType = AndroidNotificationConfig::class;

    /**
     * @var string
     */
    protected $androidDataType = '';

    /**
     * @var string
     */
    protected $iosType = IOSNotificationConfig::class;

    /**
     * @var string
     */
    protected $iosDataType = '';

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var string
     */
    protected $title;

    /**
     * @return AndroidNotificationConfig
     */
    public function getAndroid()
    {
        return $this->android;
    }

    /**
     * @param AndroidNotificationConfig $android
     */
    public function setAndroid($android)
    {
        $this->android = $android;
    }

    /**
     * @return IOSNotificationConfig
     */
    public function getIos()
    {
        return $this->ios;
    }

    /**
     * @param IOSNotificationConfig $ios
     */
    public function setIos($ios)
    {
        $this->ios = $ios;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}