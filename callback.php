<?php

require "config.php";
use Abraham\TwitterOAuth\TwitterOAuth;

try {
    if(empty($_SESSION['access_token'])){

        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            print "Old session";
            exit;
        }

        $connection = new TwitterOAuth(CONSUMER_KEY,
            CONSUMER_SECRET,
            $request_token['oauth_token'],
            $request_token['oauth_token_secret']);


        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);

        if (200 == $connection->getLastHttpCode()) {
            $_SESSION['access_token'] = $access_token;
            unset($_SESSION['oauth_token']);
            unset($_SESSION['oauth_token_secret']);
            $_SESSION['status'] = 'verified';
            echo "Please Refresh";
        } else {
            /* Save HTTP status for error dialog on connnect page.*/
            header('Location: index.php');
            exit;
        }

    } else {

        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $content = $connection->post('account_activity/all/' . ENV_NAME . '/webhooks', ["url" => URL_WEBHOOK]); // Register webhook
//        $content = $connection->post('account_activity/all/' . ENV_NAME . '/subscriptions');  // Subscribes user to registered webhook
//        $content = $connection->delete("account_activity/all/your:envName/webhooks/webhook:id"); // Delete webhook
//        $content = $connection->put('account_activity/all/' . ENV_NAME . '/webhooks/webhook:id'); // Triggers & crc request & verifies webhook again
        print "<pre>";
        print_r($content);
        print_r('Reponse code: ' . $connection->getLastHttpCode());

    }
} catch (Exception $e){
    print_r($e->getMessage());
}
