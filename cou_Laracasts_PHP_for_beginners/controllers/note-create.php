<?php
$config = require ('config.php');
$db = new Database($config['database']);


$heading = "Create a new note";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = [];
    if(strlen($_POST['body']) === 0){
        $errors['body'] = "Please enter a note";
    }

    if(strlen($_POST['body']) > 7000){
        $errors['body'] = "Note is too long, cannot be more than 7000 characters";
    }


    if(empty($errors)){
        $db->query('INSERT INTO notes (id,body,user_id) VALUES(null,:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}

require 'views/note-create.view.php';