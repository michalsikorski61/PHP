<?php
$config = require ('config.php');
$db = new Database($config['database']);


$heading = "Create a new note";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db->query('INSERT INTO notes (id,body,user_id) VALUES(null,:body, :user_id)',[
        'body' => $_POST['body'],
        'user_id' => 1
    ]);
}

require 'views/note-create.view.php';