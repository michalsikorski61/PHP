<?php
// Get the current URI
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
    '/laracasts_php_begginers/' => 'controllers/index.php',
    '/laracasts_php_begginers/about' => 'controllers/about.php',
    '/laracasts_php_begginers/notes' => 'controllers/notes.php',
    '/laracasts_php_begginers/note' => 'controllers/note.php',
    '/laracasts_php_begginers/contact' => 'controllers/contact.php'
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