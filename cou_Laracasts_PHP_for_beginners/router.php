<?php
// Get the current URI
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/' => 'controllers/index.php',
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/about' => 'controllers/about.php',
    '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/contact' => 'controllers/contact.php'
];

function abort($status_code = 404){
    http_response_code($status_code);
    $heading = $status_code;
    require "views/{$status_code}.view.php";
}
function routeToController($uri, $routes){
    if(array_key_exists($uri,$routes)){
        require $routes[$uri];
    }else{
        abort();
    }
}

routeToController($uri, $routes);