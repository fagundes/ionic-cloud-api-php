<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

class IOSNotificationConfig extends Model
{
    /**
     * The number to display as the badge of the app icon.
     *
     * @var int
     */
    protected $badge;

    /**
     * Determines if the message should be delivered as a silent notification. A value of 1 will cause the message
     * to be delivered as a background notification, which will not display a notification to the user, but the
     * application can still process the notification.
     *
     * @var int
     */
    protected $content_available;

    /**
     * Raw data sent to APNS
     *
     * @var array
     */
    protected $data;

    /**
     * Time at which APNS will stop trying to deliver the notification.
     *
     * @var string
     */
    protected $expire;

    /**
     * Notification Text.
     *
     * @var string
     */
    protected $message;

    /**
     * Custom data.
     *
     * @var array
     */
    protected $payload;

    /**
     * Message Priority. A value of 10 will cause APNS to attempt immediate delivery. A value of 5 will attempt a
     * delivery which is convenient for battery life.
     *
     * @var int
     */
    protected $priority;

    /**
     * Filename of audio file to play when a notification is received. Setting this to default will use the default
     * iOS device notification sound.
     *
     * @var string
     */
    protected $sound;

    /**
     * Default values to for template variables when a corresponding user does not have a value.
     *
     * @var array
     */
    protected $template_defaults;

    /**
     * Alert Title, only applicable for iWatch devices.
     *
     * @var string
     */
    protected $title;

    /**
     * @return int
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param int $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return int
     */
    public function getContentAvailable()
    {
        return $this->content_available;
    }

    /**
     * @param int $content_available
     */
    public function setContentAvailable($content_available)
    {
        $this->content_available = $content_available;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param string $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
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
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param string $sound
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
    }

    /**
     * @return array
     */
    public function getTemplateDefaults()
    {
        return $this->template_defaults;
    }

    /**
     * @param array $template_defaults
     */
    public function setTemplateDefaults($template_defaults)
    {
        $this->template_defaults = $template_defaults;
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