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

/*************************************************
 * Ensure you've informed the DEVICE Token       *
 *************************************************/
if (!$device_token = getDeviceToken()) {
    echo missingDeviceTokenWarning();
    return;
}

$client = new Ionic\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setApiToken($api_token);

$service = new Ionic\Service\Push($client);

// The Notification Data
$notificationMsg = new \Ionic\Service\Push\Model\NotificationMessage();
$notificationMsg->setMessage('Replace Message - ...');
$notificationMsg->setTitle('Replace Notification Title');

// The Whole Notification Input
$notificationInput  = new \Ionic\Service\Push\Model\NotificationInput();

// The Notification Input receives the data
$notificationInput->setNotification($notificationMsg);
// The Security Profile tag found in Settings › Certificates in the Dashboard, @see https://apps.ionic.io/
$notificationInput->setProfile('dev');
// The device token you registered and saved, @see http://docs.ionic.io/services/push/#registering-device-tokens
$notificationInput->setTokens([$device_token]);
$notificationInput->setScheduled(\DateTime::createFromFormat('U', strtotime('+2 minute')));

// Add Custom Message For Ios

$iosNotificationConfig = new \Ionic\Service\Push\Model\IOSNotificationConfig();

$iosNotificationConfig->setMessage('Custom Message for Android');
$iosNotificationConfig->setBadge(1);

$notificationInput->getNotification()->setIos($iosNotificationConfig);

//replaces the notifification
$notificationResult = $service->notifications->replace('NOTIFICATION_ID_HERE',$notificationInput);

echo 'UUID: ', $notificationResult->getUuid(), ' ', $notificationResult->getCreated()->format('d/m/Y \a\t H:i:s'), "<br /> \n";
echo 'UUID: ', $notificationResult->getUuid(), ' ', $notificationResult->getConfig()->getScheduled()->format('d/m/Y \a\t H:i:s'), "<br /> \n";

echo '<pre>', var_export($notificationResult), '</pre>';
