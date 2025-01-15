<?php

// Include the functions file
require ('functions.php');

class Database{
    public function query($query){
        //connect to MySQL database
        $dsn = "mysql:host=localhost;port=3306;dbname=serwer90089_laracastcphpbeggine;user=serwer90089_laracastcphpbeggine;password=iWIf2AGhumU-3R1?;charset=utf8mb4";
        $pdo = new PDO($dsn); //data source name (a str that dsdeclares connection to the db)

        $statement = $pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}

$db = new Database();
$posts = $db->query("SELECT * FROM posts");
require 'router.php';


foreach($posts as $post){
    echo "<li>{$post['title']}</li>";
}