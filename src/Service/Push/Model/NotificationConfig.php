<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

/**
 * Class NotificationConfig
 *
 * @property NotificationMessage notification
 */
class NotificationConfig extends Model
{
    /**
     * @var array
     */
    protected $tokens;

    /**
     * @var string
     */
    protected $notificationType = NotificationMessage::class;

    /**
     * @var string
     */
    protected $notificationDataType = '';

    /**
     * @var string
     */
    protected $profile;

    /**
     * @var string
     */
    protected $scheduled;

    /**
     * @return array
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param array $tokens
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @return NotificationMessage
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param NotificationMessage $notification
     */
    public function setNotification($notification)
    {
        $this->notificationType = $notification;
    }

    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param string $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return \DateTime
     */
    public function getScheduled()
    {
        var_dump($this->scheduled);
        $date = new \DateTime($this->scheduled);
        $date->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        return $date;
    }

    /**
     * @param \DateTime  $scheduled
     */
    public function setScheduled(\DateTime $scheduled)
    {
        $this->scheduled = $scheduled->format('Y-m-d\TH:i:s.uP');
    }
}