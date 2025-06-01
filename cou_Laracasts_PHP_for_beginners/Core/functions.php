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

function redirect($path){
    header("Location: {$path}");
    exit();
}
