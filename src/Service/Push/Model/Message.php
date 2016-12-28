<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

class Message extends Model
{
    /**
     * When the Message was created.
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * Messaged failed due to this error.
     *
     * @var string
     */
    protected $error;

    /**
     * Parent Notification ID.
     *
     * @var string
     */
    protected $notification;

    /**
     * Current status.
     *
     * @var string
     */
    protected $status;

    /**
     * Message was sent to this token.
     * @todo update to Token model
     *
     * @var array
     */
    protected $token;

    /**
     * Message was tied to this User ID.
     *
     * @var string
     */
    protected $user_id;

    /**
     * Message ID.
     *
     * @var string
     */
    protected $uuid;

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
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param string $notification
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
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
     * @return array|Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param array|Token $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

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
}