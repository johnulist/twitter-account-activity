<?php

use TwitAA\Services\ServiceCrcToken;
use TwitAA\Services\ServiceLog;

include "config.php";


try {
    print(ServiceCrcToken::process($_REQUEST, PATH_CRC_TOKEN));

    $jsonEvent = file_get_contents('php://input');
    ServiceLog::add($jsonEvent, PATH_LOG_EVENTS);

} catch (Exception $e){
    ServiceLog::add($e->getMessage(), PATH_LOG);
}



