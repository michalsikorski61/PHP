<?php
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve(Database::class);
$errors = [];
// $validator = new Validator();
if(! Validator::string($_POST['body'],$min = 1, $max = 2500)){
    $errors['body'] = "Please enter a note between 1 and 2500 characters";
}


if(!empty($errors)){
    //validation issue
    return view('notes/create.view.php',[
        'heading' => 'Create a new note',
        'errors' => $errors,
    ]);
}

$db->query('INSERT INTO notes (id,body,user_id) VALUES(null,:body, :user_id)',[
    'body' => $_POST['body'],
    'user_id' => $_SESSION['user']['id'],
]);

header('Location: /notes');
exit();
