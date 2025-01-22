<?php

$routes = require('routes.php');





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
// Get the current URI
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
routeToController($uri, $routes);