<?php


namespace App\Middleware;


class AuthMiddleware
{
    public static function run($params = [])
    {
        if(!auth()) {
            redirect('/login');
        }
    }
}
