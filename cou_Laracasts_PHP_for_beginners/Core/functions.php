<?php

use Core\Response;

function dd($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}
function urlIs($value){
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($status_code = 404){
    http_response_code($status_code);
        $heading = $status_code;
        require base_path("views/{$status_code}.view.php");
        exit();
}

function authorize($condition,$status = Response::FORBIDDEN){
    if(! $condition){
        abort($status);
    }
}

function base_path($path){
    return BASE_PATH . $path;
}

function view($path, $attributes = []){
    extract($attributes);
    require base_path("views/{$path}.view.php");
}

function login($user){
    $_SESSION['user'] = [
        'email' => $user['email'],
        'id' => $user['id'],
    ];
    session_regenerate_id(true);
}

function logout(){
    //log usr out
$_SESSION = [];
session_destroy();
//cookie params
$cookieParams = session_get_cookie_params();

setcookie('PHPSESSID', '', time() - 3600,$cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
}