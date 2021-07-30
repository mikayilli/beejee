<?php

namespace Config;

class Route
{
    public static $called_url = null;
    public static $called_method = null;

    public static $url = [
        'post' => [],
        'get' => [],
        'patch' => [],
        'delete' => [],
    ];

    public static function post($url,$controller,$method) {
        self::set_url('post', $url, $controller, $method);
        return new static();
    }

    public static function get($url,$controller,$method) {
        self::set_url('get', $url, $controller, $method);
        return new static();
    }

    public static function patch($url,$controller,$method) {
        self::set_url('patch', $url, $controller, $method);
        return new static();
    }

    public static function deletes($url,$controller,$method) {
        self::set_url('delete', $url, $controller, $method);
        return new static();
    }

    public static function middleware($name,$params = [])
    {
        self::$url[self::$called_method][self::$called_url]["middleware"] = [$name, $params];
        return new static();
    }

    private static function set_url($action, $url, $controller, $method) {
        self::$called_url = $url;
        self::$called_method = $action;
        self::$url[$action][$url] = ["controller" => $controller, 'method' => $method];
    }
}
