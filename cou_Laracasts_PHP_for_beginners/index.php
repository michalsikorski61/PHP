<?php

// Include the functions file
require ('functions.php');
require ('Database.php');


$db = new Database();
$post = $db->query("SELECT * FROM posts WHERE id=1")->fetch(pdo::FETCH_ASSOC);
require 'router.php';


dd($post['title']);