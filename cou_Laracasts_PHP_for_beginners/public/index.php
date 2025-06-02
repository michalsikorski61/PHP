<?php

use Core\Session;
use Core\ValidationException;

session_start();
const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include the functions file
require (BASE_PATH . 'Core/functions.php');
// spl_autoload_register(function ($class) {
//     // Zamienia "Core\Response" na "Core/Response.php"
//     $class = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $class);
    
//     // Tworzymy pełną ścieżkę do pliku
//     $file = base_path("{$class}.php");

//     if (file_exists($file)) {
//         require $file;
//     } else {
//         die("Autoload error: Class {$class} not found at {$file}");
//     }
// });
require base_path('bootstrap.php');
$router = new \Core\Router();

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST["_method"] ?? $_SERVER['REQUEST_METHOD'];



try{
    $router->route($uri,$method);
}catch(ValidationException $exception){
     Session::flash('errors', $exception->errors);
//we need to store the old input so that we can repopulate the form because post data is not available after a redirect
    Session::flash('old', $exception->old);

    return redirect($router->previusUrl());

}
// Unflash the session data after processing
Session::unflash('errors');
Session::unflash('old');
