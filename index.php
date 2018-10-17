<?php 

include "config.php";
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Prueba de conexion
 */
try {

    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    $request_token = $connection->oauth('oauth/request_token', ['oauth_callback' => OAUTH_CALLBACK]);


    switch ($connection->getLastHttpCode()) {
        case 200:
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
            /* Construir url y redirigir usuario a twitter */
            $url = $connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
            break;
        default:
            echo 'No es posible conectarse a twitter. Refresca la página o prueba más tarde.';
    }

    if(isset($url)) {
        print "<a href=".$url.">Sign In</a>";
    }

} catch (Exception $e){
    print_r($e->getMessage());
}
