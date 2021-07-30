<?php


namespace Config;


trait MiddlewareCore
{
    public static function middleware($name,$params = [])
    {
        self::$url[self::$called_method][self::$called_url]["middleware"] = [$name, $params];
    }
}
