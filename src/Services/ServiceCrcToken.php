<?php
/**
 * @author Marcos Redondo <kusflo@gmail.com>
 */

namespace TwitAA\Services;


class ServiceCrcToken
{

    public static function process( $resource, $path)
    {
        if(isset($resource['crc_token'])) {

            $file = fopen($path, "w");
            fwrite($file, $resource['crc_token']);
            fclose($file);
            $signature = hash_hmac('sha256', $resource['crc_token'], CONSUMER_SECRET, true);
            $response['response_token'] = 'sha256='.base64_encode($signature);
            return json_encode($response);
        }
        return false;
    }

}