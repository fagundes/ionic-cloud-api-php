<?php

namespace Ionic\Service\Push\Resource;

use Ionic\Service\Resource;
use Ionic\Service\Push\Model;

/**
 * The "notifications" collection of methods.
 * Typical usage is:
 *  <code>
 *   $pushService = new \Ionic\Service\Push(...);
 *   $notifications = $pushService->notifications;
 *  </code>
 */
class Notifications extends Resource
{
    /**
     * Gets notification information for a single notification. (notifications.get)
     *
     * @param string $notificationId ID of volume to retrieve.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string[] fields Additional Fields to return.
     *
     * @return Model\Notification
     */
    public function get($notificationId, $optParams = array())
    {
        $params = array('notification_id' => $notificationId);
        $params = array_merge($params, $optParams);
        return $this->call('get', array($params), Model\Notification::class);
    }


    /**
     * Performs a notification search. (notifications.listAll)
     *
     * @param array $optParams Optional parameters.
     *
     * @opt_param int page_size Sets the number of items to return in paginated endpoints.
     * @opt_param int page Sets the page number for paginated endpoints.
     * @opt_param string[] fields Additional Fields to return.
     *
     * @return Model\Notifications
     */
    public function listAll(array $optParams = [])
    {
        return $this->call('list', [$optParams], Model\Notifications::class);
    }

}