<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once 'templates/base.php';

/*************************************************
 * Ensure you've informed
 ************************************************/
if (!$api_token = getApiToken()) {
    echo missingApiTokenWarning();
    return;
}

$client = new Ionic\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setApiToken($api_token);

$service = new Ionic\Service\Push($client);

$results = $service->notifications->listAll();

foreach ($results->getItems() as $notification) {
    echo 'UUID: ', $notification->getUuid(), ' ', $notification->getCreated()->format('d/m/Y \a\t H:i'), "<br /> \n";
}

//$notification = $service->notifications->get('NOTIFICATION_ID_HERE');
//
//echo '<pre>';
//var_dump($notification);
//var_dump($notification->getCreated()->format('d/m/Y'));