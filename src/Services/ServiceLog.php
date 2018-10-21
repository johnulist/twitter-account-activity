<?php
/**
 * @author Marcos Redondo <kusflo@gmail.com>
 */

namespace TwitAA\Services;


class ServiceLog
{

    public static function add( $txt, $path)
    {
        $file = fopen($path, "a");
        fwrite($file, $txt . PHP_EOL);
        fclose($file);
    }

}