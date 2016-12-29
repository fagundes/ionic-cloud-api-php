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

$token = 'd6a6be2ee707116c341238c9c7dd8771'; //ensures to be a token

//deletes device token
$response = $service->deviceTokens->delete(md5($token));

echo '<pre>', var_export($response->getStatusCode()), '</pre>';