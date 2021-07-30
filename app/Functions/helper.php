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

function paginate($paginate) {
    require_once __DIR__ ."/../../views/paginate/paginate.php";
}

function check_csrf() {
    if(get_method() !== 'get') {
        if(csrf_token() != request('_token')) {
            throw new Exception('Page session has expired');
        }
    }
}

function csrf_field() {
    echo "<input type='hidden' name='_token' value='". csrf_token() ."'>";
}

function csrf_token() {
    return session_get('csrf');
}

function create_csrf() {
    if(!session_get('csrf')) {
        session_set('csrf', bin2hex(openssl_random_pseudo_bytes(32)));
    }
}

function update_csrf() {
    if(get_method() !== 'get') {
        session_set('csrf', bin2hex(openssl_random_pseudo_bytes(32)));
    }
}

function old($key) {
    if(session_get('old') && isset(session_get('old')['data']) && isset(session_get('old')['data'][$key]))
      return session_get('old')['data'][$key];

    return "";
}

function expect($key, $arr) {
    unset($arr[$key]);
    return $arr;
}
