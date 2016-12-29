<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

class DeviceTokenInput extends Model
{
    /**
     * Device Token.
     *
     * @var string
     */
    protected $token;

    /**
     * User ID. Associate the token with the User.
     *
     * @var string
     */
    protected $user_id;

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

}