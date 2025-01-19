<?php
$config = require ('config.php');
require 'Response.php';

$db = new Database($config['database']);
$heading = "Note";
// $id = $_GET['id'];
$note =$db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_GET['id']
])->fetch();

if(!$note){
   abort();
}
$curentUserId = 1;
if($note['user_id'] !== $curentUserId){
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";