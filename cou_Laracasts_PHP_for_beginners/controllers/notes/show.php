<?php

use Core\App;
use Core\Database;
$db = App::resolve(Database::class);

$curentUserId = 1;

$note =$db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_GET['id']
])->findOrFail();


authorize($note['user_id'] === $curentUserId);



view("notes/show",[
    "heading" => "Note",
    "note" => $note,
]);
