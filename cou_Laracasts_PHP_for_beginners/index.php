<?php

// Include the functions file
require ('functions.php');

require 'router.php';

//connect to MySQL database
$dsn = "mysql:host=localhost;port=3306;dbname=serwer90089_laracastcphpbeggine;user=serwer90089_laracastcphpbeggine;password=;charset=utf8mb4";
$pdo = new PDO($dsn); //data source name (a str that dsdeclares connection to the db)

$statement = $pdo->prepare("SELECT * FROM posts");

$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($posts as $post){
    echo "<li>{$post['title']}</li>";
}