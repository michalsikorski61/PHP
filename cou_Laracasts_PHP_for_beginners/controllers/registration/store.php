<?php

use Core\Validator;
use Core\App;
use Core\Database;
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];


//validate the form input
if(!Validator::email($email)){
    $errors['email'] = "Please enter a valid email address";
}

if(!Validator::string($password, $min = 8, $max = 255)){
    $errors['password'] = "Please enter a password between 8 and 255 characters";
}


if(!empty($errors)){
    return view('registration/create',[
        'errors' => $errors,
    ]);
}
//check if account already exists
$db = App::resolve(Database::class);
$result = $db->query('SELECT * FROM users WHERE email = :email',[
    'email' => $email
])->find();

//if yes, redirect to login
if($result){
    header('Location: /');
    exit();
}

//if no, create a new account in the database, log in, and redirect to the notes page
$db->query('INSERT INTO users (email, password) VALUES (:email, :password)',[
    'email' => $email,
    'password' => $password,
]);

$_SESSION['user'] = [
    'email' => $email,
];
header('Location: /notes');
exit();