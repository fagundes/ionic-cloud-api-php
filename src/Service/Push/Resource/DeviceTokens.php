<?php

namespace Ionic\Service\Push\Resource;

use Ionic\Service\Auth\Model\Users;
use Ionic\Service\Resource;
use Ionic\Service\Push\Model;
use Psr\Http\Message\ResponseInterface;

/**
 * The "deviceTokens" collection of methods.
 * Typical usage is:
 *  <code>
 *   $pushService = new \Ionic\Service\Push(...);
 *   $deviceTokens = $pushService->deviceTokens;
 *  </code>
 */
class DeviceTokens extends Resource
{
    /**
     * Associate a token to an user (deviceTokens.associateUser)
     *
     * @param string $tokenId Token ID (MD5 Hash of the token)
     * @param string $userId User ID
     * @param array $optParams Optional parameters.
     *
     * @return ResponseInterface
     */
    public function associateUser($tokenId, $userId, $optParams = [])
    {
        $params = ['token_id' => $tokenId, 'user_id' => $userId];
        $params = array_merge($params, $optParams);
        return $this->call('associateUser', [$params]);
    }

    /**
     * Saves a device token that was previously generated by a device platform. (deviceTokens.create)
     *
     * @param Model\DeviceTokenInput $postBody
     * @param array $optParams Optional parameters.
     *
     * @return Model\DeviceToken
     */
    public function create(Model\DeviceTokenInput $postBody, $optParams = [])
    {
        $params = ['postBody' => $postBody];
        $params = array_merge($params, $optParams);
        return $this->call('create', [$params], Model\DeviceToken::class);
    }

    /**
     * Deletes a Device Token. (deviceTokens.delete)
     *
     * @param string $tokenId Token ID (MD5 Hash of the token) to delete.
     * @param array $optParams Optional parameters.
     *
     * @return ResponseInterface
     */
    public function delete($tokenId, $optParams = [])
    {
        $params = ['token_id' => $tokenId];
        $params = array_merge($params, $optParams);
        return $this->call('delete', [$params]);
    }

    /**
     * Dissociate a token to an user (deviceTokens.dissociateUser)
     *
     * @param string $tokenId Token ID (MD5 Hash of the token)
     * @param string $userId User ID
     * @param array $optParams Optional parameters.
     *
     * @return ResponseInterface
     */
    public function dissociateUser($tokenId, $userId, $optParams = [])
    {
        $params = ['token_id' => $tokenId, 'user_id' => $userId];
        $params = array_merge($params, $optParams);
        return $this->call('dissociateUser', [$params]);
    }

    /**
     * Get information about a specific Token. Remember to use an MD5 hash of the token string you are trying
     * to retrieve for the Token ID. (notifications.get)
     *
     * @param string $tokenId Token ID (MD5 Hash of the token).
     * @param array $optParams Optional parameters.
     *
     * @opt_param string[] fields Additional Fields to return.
     *
     * @return Model\DeviceToken
     */
    public function get($tokenId, $optParams = [])
    {
        $params = ['token_id' => $tokenId];
        $params = array_merge($params, $optParams);
        return $this->call('get', [$params], Model\DeviceToken::class);
    }

    /**
     * Returns a paginated listing of associated users of a Device Token. (deviceTokens.listAssociatedUsers)
     *
     * @param string $tokenId Token ID (MD5 Hash of the token).
     * @param array $optParams Optional parameters.
     *
     * @opt_param int page_size Sets the number of items to return in paginated endpoints.
     * @opt_param int page Sets the page number for paginated endpoints.
     *
     * @return Users
     */
    public function listAssociatedUsers($tokenId, array $optParams = [])
    {
        $params = ['token_id' => $tokenId];
        $params = array_merge($params, $optParams);
        return $this->call('listAssociatedUsers', [$params], Users::class);
    }

    /**
     * Returns a paginated listing of Device Tokens. (deviceTokens.listDeviceTokens)
     *
     * @param array $optParams Optional parameters.
     *
     * @opt_param int page_size Sets the number of items to return in paginated endpoints.
     * @opt_param int page Sets the page number for paginated endpoints.
     * @opt_param bool show_invalid Determines whether to include invalidated tokens.
     * @opt_param string user_id Only display tokens associated with the User ID.
     *
     * @return Model\DeviceTokens
     */
    public function listDeviceTokens(array $optParams = [])
    {
        return $this->call('list', [$optParams], Model\DeviceTokens::class);
    }

    /**
     * Update information from an existing Device Token. (deviceTokens.replace)
     *
     * @param string $tokenId ID of token to update.
     * @param bool $valid Determines whether the device token is valid
     * @param array $optParams Optional parameters.
     *
     * @return Model\DeviceToken
     */
    public function update($tokenId, $valid, $optParams = [])
    {
        $params = ['token_id' => $tokenId, 'postBody' => ['valid' => $valid]];
        $params = array_merge($params, $optParams);
        return $this->call('replace', [$params], Model\DeviceToken::class);
    }
}