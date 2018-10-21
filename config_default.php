<?php

/** Create config.php file with the same structure as config_default.php  */

session_start();
require 'vendor/autoload.php';

define('CONSUMER_KEY', 'YOUR CONSUMER KEY');
define('CONSUMER_SECRET', 'YOUR CONSUMER SECRET');

define('OAUTH_CALLBACK', 'YOUR CALLBACK URL');
define('URL_WEBHOOK', 'YOUR WEBHOOK URL');
define('ENV_NAME', 'YOUR ENVIRONMENT NAME');
define('PATH_CRC_TOKEN', 'PATH OF YOUR CRC TOKEN');


/**
 * Logs
 */

define('PATH_LOG_EVENTS', 'PATH OF YOUR EVENTS LOG');
define('PATH_LOG_ERRORS', 'PATH OF YOUR ERROR LOG');


/**
 * Mail
 */

define('MAIL_FROM', 'YOUR MAIL FROM');
define('MAIL_TO', 'YOUR MAIL TO');

/**
 * Persist in BBDD (MySQL)
 */

$configDoctrine = new \Doctrine\DBAL\Configuration();

$connectionParams = array(
    'dbname' => 'YOUR BBDD NAME',
    'user' => 'YOUR USER NAME',
    'password' => 'YOUR PASS',
    'host' => 'YOUR HOST',
    'driver' => 'pdo_mysql',
    'port' => 'YOUR PORT',
    'charset'  => 'utf8',
);

if (!CONSUMER_KEY || !CONSUMER_SECRET || !OAUTH_CALLBACK) {
    exit('The CONSUMER_KEY, CONSUMER_SECRET, and OAUTH_CALLBACK environment variables must be set to use this demo.'
         . 'You can register an app with Twitter at https://apps.twitter.com/.');
}



