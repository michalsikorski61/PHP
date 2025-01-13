<?php
// Include the functions file
require ('functions.php');

// Get the current URI
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/' => 'controllers/index.php',
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/about' => 'controllers/about.php',
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/contact' => 'controllers/contact.php'
];
if(array_key_exists($uri,$routes)){
    require $routes[$uri];
}else{
    http_response_code(404);
    $heading = '404 Not Found';
    require 'views/404.view.php';
}