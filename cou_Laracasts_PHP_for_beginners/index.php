<?php

// Include the functions file
require ('functions.php');

class Database{
    public function query(){
        //connect to MySQL database
        $dsn = "mysql:host=localhost;port=3306;dbname=serwer90089_laracastcphpbeggine;user=serwer90089_laracastcphpbeggine;password=;charset=utf8mb4";
        $pdo = new PDO($dsn); //data source name (a str that dsdeclares connection to the db)

        $statement = $pdo->prepare("SELECT * FROM posts");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}

$db = new Database();
$posts = $db->query();
require 'router.php';


foreach($posts as $post){
    echo "<li>{$post['title']}</li>";
}