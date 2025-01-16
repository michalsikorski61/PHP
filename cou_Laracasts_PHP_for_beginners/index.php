<?php

// Include the functions file
require ('functions.php');
require ('Database.php');
$config = require ('config.php');

$db = new Database($config);

$post = $db->query("SELECT * FROM posts WHERE id=1")->fetchALL();
require 'router.php';


dd($post);