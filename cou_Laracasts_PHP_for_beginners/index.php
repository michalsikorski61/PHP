<?php

// Include the functions file
require ('functions.php');

class Database{

    public $connection;
    public function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=serwer90089_laracastcphpbeggine;user=serwer90089_laracastcphpbeggine;password=;charset=utf8mb4";
        
        $this->connection = new PDO($dsn); //data source name (a str that dsdeclares connection to the db)
    }


    public function query($query){
        //connect to MySQL database
       

        $statement = $this->connection->prepare($query);

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