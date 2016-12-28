<?php

namespace Ionic\Service\Push\Resource;

use Ionic\Service\Resource;
use Ionic\Service\Push\Model;
use Psr\Http\Message\ResponseInterface;

/**
 * The "messages" collection of methods.
 * Typical usage is:
 *  <code>
 *   $pushService = new \Ionic\Service\Push(...);
 *   $messages = $pushService->messages;
 *  </code>
 */
class Messages extends Resource
{
    /**
     * Get Message details. Use this endpoint to check the current status of a message or to lookup the error code
     * for failures. (messages.get)
     *
     * @param string $messageId ID of message to retrieve.
     * @param array $optParams Optional parameters.
     *
     * @return Model\Message
     */
    public function get($messageId, $optParams = [])
    {
        $params = ['message_id' => $messageId];
        $params = array_merge($params, $optParams);
        return $this->call('get', [$params], Model\Message::class);
    }

    /**
     * Deletes a message. (messages.delete)
     *
     * @param string $messageId ID of message to delete.
     * @param array $optParams Optional parameters.
     *
     * @return ResponseInterface
     */
    public function delete($messageId, $optParams = [])
    {
        $params = ['message_id' => $messageId];
        $params = array_merge($params, $optParams);
        return $this->call('delete', [$params]);
    }
}