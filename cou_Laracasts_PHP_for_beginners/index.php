<?php

// Include the functions file
require ('functions.php');
require ('Database.php');


$db = new Database();
$post = $db->query("SELECT * FROM posts WHERE id=1")->fetchALL();
require 'router.php';


dd($post['title']);