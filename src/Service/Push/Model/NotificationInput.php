<?php

namespace Ionic\Service\Push\Model;

use Ionic\Model;

/**
 * Class NotificationInput
 *
 * @property NotificationConfig notification
 */
class NotificationInput extends Model
{
    /**
     * @var string[]
     */
    protected $emails;

    /**
     * @var string[]
     */
    protected $external_ids;

    /**
     * @var string[]
     */
    protected $facebook_ids;

    /**
     * @var string[]
     */
    protected $github_ids;

    /**
     * @var string[]
     */
    protected $google_ids;

    /**
     * @var string[]
     */
    protected $instagram_ids;

    /**
     * @var string[]
     */
    protected $linkedin_ids;

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
     * @var boolean
     */
    protected $send_to_all;

    /**
     * @var string[]
     */
    protected $tokens;

    /**
     * @var string[]
     */
    protected $twitter_ids;

    /**
     * @var string[]
     */
    protected $user_ids;

    /**
     * @return \string[]
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param \string[] $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return \string[]
     */
    public function getExternalIds()
    {
        return $this->external_ids;
    }

    /**
     * @param \string[] $external_ids
     */
    public function setExternalIds($external_ids)
    {
        $this->external_ids = $external_ids;
    }

    /**
     * @return \string[]
     */
    public function getFacebookIds()
    {
        return $this->facebook_ids;
    }

    /**
     * @param \string[] $facebook_ids
     */
    public function setFacebookIds($facebook_ids)
    {
        $this->facebook_ids = $facebook_ids;
    }

    /**
     * @return \string[]
     */
    public function getGithubIds()
    {
        return $this->github_ids;
    }

    /**
     * @param \string[] $github_ids
     */
    public function setGithubIds($github_ids)
    {
        $this->github_ids = $github_ids;
    }

    /**
     * @return \string[]
     */
    public function getGoogleIds()
    {
        return $this->google_ids;
    }

    /**
     * @param \string[] $google_ids
     */
    public function setGoogleIds($google_ids)
    {
        $this->google_ids = $google_ids;
    }

    /**
     * @return \string[]
     */
    public function getInstagramIds()
    {
        return $this->instagram_ids;
    }

    /**
     * @param \string[] $instagram_ids
     */
    public function setInstagramIds($instagram_ids)
    {
        $this->instagram_ids = $instagram_ids;
    }

    /**
     * @return \string[]
     */
    public function getLinkedinIds()
    {
        return $this->linkedin_ids;
    }

    /**
     * @param \string[] $linkedin_ids
     */
    public function setLinkedinIds($linkedin_ids)
    {
        $this->linkedin_ids = $linkedin_ids;
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
        $this->notification = $notification;
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

    /**
     * @return boolean
     */
    public function isSendToAll()
    {
        return $this->send_to_all;
    }

    /**
     * @param boolean $send_to_all
     */
    public function setSendToAll($send_to_all)
    {
        $this->send_to_all = $send_to_all;
    }

    /**
     * @return \string[]
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param \string[] $tokens
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @return \string[]
     */
    public function getTwitterIds()
    {
        return $this->twitter_ids;
    }

    /**
     * @param \string[] $twitter_ids
     */
    public function setTwitterIds($twitter_ids)
    {
        $this->twitter_ids = $twitter_ids;
    }

    /**
     * @return \string[]
     */
    public function getUserIds()
    {
        return $this->user_ids;
    }

    /**
     * @param \string[] $user_ids
     */
    public function setUserIds($user_ids)
    {
        $this->user_ids = $user_ids;
    }

}