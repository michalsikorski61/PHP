<?php

// Include the functions file
require ('functions.php');
require ('Database.php');
$config = [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'serwer90089_laracastcphpbeggine',
    'charset' => 'utf8mb4'
];

$db = new Database($config);

$post = $db->query("SELECT * FROM posts WHERE id=1")->fetchALL();
require 'router.php';


dd($post);