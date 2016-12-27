<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

class AndroidNotificationConfig extends Model
{

    /**
     * Identifies a group of messages that can be collapsed, so that only the last message gets sent when delivery
     * can be resumed.
     *
     * @var string
     */
    protected $collapse_key;

    /**
     * Determines if the message should be delivered as a silent notification. A value of 1 will cause the message
     * to be delivered as a background notification, which will not display a notification to the user, but the
     * application can still process the notification.
     *
     * @var int
     */
    protected $content_available;

    /**
     * Raw data sent to GCM
     *
     * @var array
     */
    protected $data;

    /**
     * When this parameter is set to true, it indicates that the message should not be sent until the device becomes
     * active.
     *
     * @var bool
     */
    protected $delay_while_idle;

    /**
     * Filename of the Icon to display with the notification.
     *
     * @var string
     */
    protected $icon;

    /**
     * Filename or URI of an image file to display with the notification.
     *
     * @var string
     */
    protected $image;

    /**
     * Message Text.
     *
     * @var string
     */
    protected $message;

    /**
     * Custom data
     *
     * @var array
     */
    protected $payload;

    /**
     * Filename of audio file to play when a notification is received. Setting this to default will use the default
     * Android device notification sound.
     *
     * @var string
     */
    protected $sound;

    /**
     * Indicates whether each notification message results in a new entry on the notification center on Android. If
     * not set, each request creates a new notification. If set, and a notification with the same tag is already being
     * shown, the new notification replaces the existing one in notification center.
     *
     * @var string
     */
    protected $tag;

    /**
     * Default values for template variables when a corresponding user does not have a value. ?
     *
     * @var array
     */
    protected $template_defaults;

    /**
     * This parameter specifies how long (in seconds) the message should be kept in GCM storage if the device is
     * offline.
     *
     * @var int
     */
    protected $time_to_live;

    /**
     * Notification Title
     *
     * @var string
     */
    protected $title;

    /**
     * @return string
     */
    public function getCollapseKey()
    {
        return $this->collapse_key;
    }

    /**
     * @param string $collapse_key
     */
    public function setCollapseKey($collapse_key)
    {
        $this->collapse_key = $collapse_key;
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
     * @return boolean
     */
    public function isDelayWhileIdle()
    {
        return $this->delay_while_idle;
    }

    /**
     * @param boolean $delay_while_idle
     */
    public function setDelayWhileIdle($delay_while_idle)
    {
        $this->delay_while_idle = $delay_while_idle;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
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
     * @return int
     */
    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    /**
     * @param int $time_to_live
     */
    public function setTimeToLive($time_to_live)
    {
        $this->time_to_live = $time_to_live;
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