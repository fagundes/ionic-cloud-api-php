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

$results = $service->deviceTokens->listDeviceTokens(['page' => 1, 'page_size' => 4]);

foreach ($results->getItems() as $deviceToken) {
    echo 'ID: ', $deviceToken->getId(), ' Is Valid: ',$deviceToken->isValid(), ' Created At: ', $deviceToken->getCreated()->format('d/m/Y \a\t H:i:s P'), "<br /> \n";
}

$deviceToken = $service->deviceTokens->get('67e07fb98c7f2f080d860a4fedd9d8fc');

echo '<pre>';
var_dump($deviceToken);
var_dump($deviceToken->getType());
var_dump($deviceToken->getCreated()->format('d/m/Y'));
var_dump($deviceToken->getId());
var_dump($deviceToken->getToken());
var_dump(md5($deviceToken->getToken()));