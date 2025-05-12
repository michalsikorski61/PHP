<?php


//find corresponding note
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve(Database::class);

$currentUserId = 1;
$note = $db->query('SELECT * FROM notes WHERE id = :id',[
    'id' => $_POST['id']
])->findOrFail();


//auth that the current user can edit the note
authorize($note['user_id'] === $currentUserId);
//validate the form
$errors = [];

if(! Validator::string($_POST['body'], $min = 10, $max = 2000)){
    $errors['body'] = "Please enter a note between 10 and 2000 characters";
}
// if no validation errrors, update the record in the note database table
if(empty($errors)){
    $db->query('UPDATE notes SET body = :body WHERE id = :id',[
        'body' => $_POST['body'],
        'id' => $_POST['id']
    ]);
    header('Location: /notes');
    exit();
}

view('notes/edit',[
    'heading' => 'Edit Note',
    'note' => $note,
    'errors' => $errors,
]);