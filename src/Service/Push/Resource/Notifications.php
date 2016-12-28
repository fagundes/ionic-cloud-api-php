<?php

namespace Ionic\Service\Push\Resource;

use Ionic\Service\Resource;
use Ionic\Service\Push\Model;
use Psr\Http\Message\ResponseInterface;

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
     * Creates a Push Notification. (notifications.create)
     *
     * @param Model\NotificationInput $postBody
     * @param array $optParams Optional parameters.
     *
     * @return Model\Notification
     */
    public function create(Model\NotificationInput $postBody, $optParams = [])
    {
        $params = ['postBody' => $postBody];
        $params = array_merge($params, $optParams);
        return $this->call('create', [$params], Model\Notification::class);
    }

    /**
     * Deletes a Notification. (notifications.delete)
     *
     * @param string $notificationId ID of notification to delete.
     * @param array $optParams Optional parameters.
     *
     * @return ResponseInterface
     */
    public function delete($notificationId, $optParams = [])
    {
        $params = ['notification_id' => $notificationId];
        $params = array_merge($params, $optParams);
        return $this->call('delete', [$params]);
    }

    /**
     * Gets a Notification. (notifications.get)
     *
     * @param string $notificationId ID of notification to retrieve.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string[] fields Additional Fields to return.
     *
     * @return Model\Notification
     */
    public function get($notificationId, $optParams = [])
    {
        $params = ['notification_id' => $notificationId];
        $params = array_merge($params, $optParams);
        return $this->call('get', [$params], Model\Notification::class);
    }

    /**
     * Returns a paginated listing of Push Notifications for an App. (notifications.listNotifications)
     *
     * @param array $optParams Optional parameters.
     *
     * @opt_param int page_size Sets the number of items to return in paginated endpoints.
     * @opt_param int page Sets the page number for paginated endpoints.
     * @opt_param string[] fields Additional Fields to return.
     *
     * @return Model\Notifications
     */
    public function listNotifications(array $optParams = [])
    {
        return $this->call('list', [$optParams], Model\Notifications::class);
    }

    /**
     * Replaces information from an existing Notification. (notifications.replace)
     *
     * @param string $notificationId ID of notificaion to replace.
     * @param Model\NotificationInput $postBody
     * @param array $optParams Optional parameters.
     *
     * @return Model\Notification
     */
    public function replace($notificationId, Model\NotificationInput $postBody, $optParams = [])
    {
        $params = ['notification_id' => $notificationId, 'postBody' => $postBody];
        $params = array_merge($params, $optParams);
        return $this->call('replace', [$params], Model\Notification::class);
    }

    /**
     * Lists Messages from a Notification. (notifications.listMessages)
     *
     * @param $notificationId
     * @param array $optParams
     *
     * @opt_param int page_size Sets the number of items to return in paginated endpoints.
     * @opt_param int page Sets the page number for paginated endpoints.
     *
     * @return Model\Messages
     */
    public function listMessages($notificationId, $optParams = [])
    {
        $params = ['notification_id' => $notificationId];
        $params = array_merge($params, $optParams);
        return $this->call('listMessages', [$params], Model\Messages::class);
    }

}