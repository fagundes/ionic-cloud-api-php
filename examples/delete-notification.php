<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once 'templates/base.php';

/*************************************************
 * Ensure you've informed the API Token          *
 *************************************************/
if (!$api_token = getApiToken()) {
    echo missingApiTokenWarning();
    return;
}

$client = new Ionic\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setApiToken($api_token);

$service = new Ionic\Service\Push($client);

$notificationId = 'cd07de07-e553-491c-990b-bc659289c6a5'; //ensures to be a real notification uuid

//creates the notifification
$response = $service->notifications->delete($notificationId);

echo '<pre>', var_export($response->getStatusCode()), '</pre>';