<?php

function view($path, $data = []) {
    extract($data);
    return include_once __DIR__."/../../views/" . $path .".php";
}

function auth() {
    return isset($_SESSION['user']);
}

function get_method() {
    return strtolower($_SERVER['REQUEST_METHOD']);
}

function redirect($url) {
    return header("Location: ". $url);
}

function request($key) {
    if(isset($_REQUEST[$key]))
        return htmlspecialchars(htmlentities(trim($_REQUEST[$key])));
    return null;
}

function current_uri() {
    $uri = explode("?" ,$_SERVER['REQUEST_URI']);
    return $uri[0];
}

function prev_uri() {
    return $_SERVER['HTTP_REFERER'];
}

function session_set($key, $value) {
    return $_SESSION[$key] = $value;
}

function session_get($key) {
    return $_SESSION[$key] ?? false;
}

function errors($key) {
    $errors = session_get('errors') ?? [];

    if(isset($errors[$key])) return $errors[$key];

    return;
}
