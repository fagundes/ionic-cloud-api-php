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

$messages = $service->notifications->listMessages('NOTIFICATION_ID_HERE');

foreach ($messages->getItems() as $message) {
    echo 'UUID: ', $message->getUuid(), ' ', $message->getCreated()->format('d/m/Y \a\t H:i:s P'), "<br /> \n";
}