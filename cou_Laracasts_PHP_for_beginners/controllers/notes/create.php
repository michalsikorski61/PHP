<?php

use Core\Database;
use Core\Validator;

base_path('Validator.php');

$config = require base_path('config.php');
$db = new Database($config['database']);
$errors = [];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // $validator = new Validator();
    if(! Validator::string($_POST['body'],$min = 1, $max = 2500)){
        $errors['body'] = "Please enter a note between 1 and 2500 characters";
    }

    


    if(empty($errors)){
        $db->query('INSERT INTO notes (id,body,user_id) VALUES(null,:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}

view("notes/create", [
    "heading" => "Create a new note",
    "errors" => $errors,
]);