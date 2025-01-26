<?php
$config = require base_path('config.php');


$db = new Database($config['database']);

// $id = $_GET['id'];
$note =$db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_GET['id']
])->findOrFail();


$curentUserId = 1;
authorize($note['user_id'] === $curentUserId);



view("notes/show",[
    "heading" => "Note",
    "note" => $note,
]);