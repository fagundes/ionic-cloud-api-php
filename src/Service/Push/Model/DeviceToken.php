<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

class DeviceToken extends Model
{
    /**
     * App ID the Token belongs to.
     * @var string
     */
    protected $app_id;

    /**
     * When the Token was created.
     *
     * @var \DateTime
     */
    protected $created;

    /**
     * Token ID. A MD5 hash of the device token.
     *
     * @var string
     */
    protected $id;

    /**
     * When the Token was last invalidated.
     *
     * @var \DateTime
     */
    protected $invalidated;

    /**
     * Platform of the Token.
     *
     * @var string
     */
    protected $token;

    /**
     * Platform of the Token.
     *
     * @var string
     */
    protected $type;

    /**
     * Validity of the Token.
     *
     * @var bool
     */
    protected $valid;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getInvalidated()
    {
        return $this->invalidated;
    }

    /**
     * @param \DateTime $invalidated
     */
    public function setInvalidated($invalidated)
    {
        $this->invalidated = $invalidated;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param boolean $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

}