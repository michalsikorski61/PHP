<?php
require('Validator.php');

$config = require ('config.php');
$db = new Database($config['database']);


$heading = "Create a new note";



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];
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

require 'views/note-create.view.php';