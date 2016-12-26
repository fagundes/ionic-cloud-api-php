<?php

include_once __DIR__ . '/../vendor/autoload.php';

$client = new Ionic\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setApiToken("API_TOKEN_HERE");

$service = new Ionic\Service\Notifications($client);

$results = $service->notifications->listAll();

echo '<pre>';

foreach ($results->getItems() as $notification) {
    echo 'UUID: ', $notification->getUuid(), ' ', $notification->getCreated()->format('d/m/Y \a\t H:i'), "<br /> \n";
}

//$notification = $service->notifications->get('NOTIFICATION_ID_HERE');
//
//echo '<pre>';
//var_dump($notification);
//var_dump($notification->getCreated()->format('d/m/Y'));