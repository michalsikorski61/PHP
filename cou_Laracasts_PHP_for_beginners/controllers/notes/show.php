<?php

use Core\Database;

$config = require base_path('config.php');


$db = new Database($config['database']);
$curentUserId = 1;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $note =$db->query('SELECT * FROM notes WHERE id = :id',[
        'id' => $_GET['id']
    ])->findOrFail();


    authorize($note['user_id'] === $curentUserId);
    //form was submitted delete the current note
    $db->query('DELETE FROM notes WHERE id = :id',[
        'id' => $_POST['id'],
    ]);
    
    header('Location: /notes');
    exit();
}else{

    // $id = $_GET['id'];
    $note =$db->query('SELECT * FROM notes WHERE id = :id',[
        'id' => $_GET['id']
    ])->findOrFail();


    authorize($note['user_id'] === $curentUserId);



    view("notes/show",[
        "heading" => "Note",
        "note" => $note,
    ]);
}