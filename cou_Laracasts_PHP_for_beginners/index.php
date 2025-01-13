<?php
// Include the functions file
require ('functions.php');

// Get the current URI
$uri = $_SERVER['REQUEST_URI'];
// Parse the URI to get its components
$uri = parse_url($uri);

// Route the request to the appropriate controller based on the path
if($uri['path'] === '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/'){
    // If the path is the root, include the index controller
    require 'controllers/index.php';
}else if($uri['path'] === '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/about'){
    // If the path is /about, include the about controller
    require 'controllers/about.php';
}else if($uri['path'] === '/php/nauka_php/_2024/GITHUB_POWERED/PHP_JOURNEY/cou_Laracasts_PHP_for_beginners/contact'){
    // If the path is /contact, include the contact controller
    require 'controllers/contact.php';
}