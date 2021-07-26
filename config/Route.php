<?php

namespace Config;

class Route
{
    public static $url = [
        'post' => [],
        'get' => [],
        'patch' => [],
        'delete' => [],
    ];

    public static function post($url,$controller,$method) {
        self::$url['post'][$url] = ["controller" => $controller, 'method' => $method];
    }

    public static function get($url,$controller,$method) {
        self::$url['get'][$url] = ["controller" => $controller, 'method' => $method];
    }

    public static function patch($url,$controller,$method) {
        self::$url['patch'][$url] = ["controller" => $controller, 'method' => $method];
    }

    public static function deletes($url,$controller,$method) {
        self::$url['delete'][$url] = ["controller" => $controller, 'method' => $method];
    }
}
