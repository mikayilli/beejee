<?php

session_start();
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/Functions/helper.php";
require_once __DIR__ . "/app/middlewares.php";
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/route/route.php";

use Config\Route;
//die(var_dump($_REQUEST));
create_csrf();
check_csrf();
update_csrf();

$request_method = get_method();

if(!in_array($request_method, ['post', 'get', 'put', 'head'])) {
    throw new Exception('Method Not Allowed');
}

$uri = current_uri();
if(empty($uri)) { $uri = '/'; }

if(!isset(Route::$url[$request_method][$uri])){
    throw new Exception("Route '{$uri}' Not Found");
}

$controller = "\App\Http\Controller\\".Route::$url[$request_method][$uri]['controller'];
$method = Route::$url[$request_method][$uri]['method'];

if( isset(Route::$url[$request_method][$uri]['middleware'])) {
    $current_middleware = Route::$url[$request_method][$uri]['middleware'];
    if(isset($GLOBALS['middlewares'][$current_middleware[0]])) {
            $GLOBALS['middlewares'][$current_middleware[0]]::run($current_middleware[1]);
    } else {
        throw new \Exception("$current_middleware[0] middleware not found");
    }
}

if(!class_exists($controller)) {
    throw new Exception("'{$controller}' Controller Not Found");
}

if(!method_exists($controller, $method)) {
    throw new Exception("method '{$method}' not found on '{$controller}' Class");
}

(new $controller)->{$method}();
