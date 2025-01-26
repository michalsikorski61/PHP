<?php
$config = require ('config.php');
require __DIR__.'/../Response.php';

$db = new Database($config['database']);
$heading = "Note";
// $id = $_GET['id'];
$note =$db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_GET['id']
])->findOrFail();


$curentUserId = 1;
authorize($note['user_id'] === $curentUserId);



require "views/notes/show.view.php";