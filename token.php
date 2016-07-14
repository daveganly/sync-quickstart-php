<?php
include 'vendor/autoload.php';
require_once('./randos.php');
require_once('./config.php');

// An identifier for your app - can be anything you'd like
$appName = 'TwilioSyncDemo';

// choose a random username for the connecting user
$identity = randomUsername();

// A device ID is passed as a query string parameter to this script
$deviceId = $_GET['device'];

// The endpoint ID is a combination of the above
$endpointId = $appName . ':' . $identity . ':' . $deviceId;

// Create access token, which we will serialize and send to the client
$token = new Twilio\AccessToken(
    $TWILIO_ACCOUNT_SID, 
    $TWILIO_API_KEY, 
    $TWILIO_API_SECRET, 
    3600, 
    $identity
);

// Create IP Messaging grant
$syncGrant = new Twilio\Auth\SyncGrant();
$syncGrant->setServiceSid($TWILIO_SYNC_SERVICE_SID);
$syncGrant->setEndpointId($endpointId);

// Add grant to token
$token->addGrant($syncGrant);

// return serialized token and the user's randomly generated ID
echo json_encode(array(
    'identity' => $identity,
    'token' => $token->toJWT(),
));