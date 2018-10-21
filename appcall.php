<?php


require "config.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

//$content = $connection->post('account_activity/all/' . ENV_NAME . '/subscriptions');

$content = $connection->get('account_activity/all/webhooks');
//$content = $connection->get('account_activity/all/subscriptions/count');
//$content = $connection->get('account_activity/all/' . ENV_NAME . '/subscriptions/list');

//$content = $connection->get('account_activity/all/' . ENV_NAME . '/subscriptions');
//$content = $connection->post('account_activity/all/' . ENV_NAME . '/subscriptions');



print "<pre>";
print_r($content);
print_r('Reponse code: ' . $connection->getLastHttpCode());
