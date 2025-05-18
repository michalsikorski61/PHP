<?php

use Core\App;
use Core\Database;
use Core\Validator;

// log in the usr if the creadentials are correct
$db = App::resolve(Database::class);
//check form is valid
$email = $_POST['email'];
$password = $_POST['password'];
$errors = [];

if(!Validator::email($email)){
    $errors['email'] = "Please enter a valid email address";
}

if(!Validator::string($password, )){
    $errors['password'] = "Please enter a password betweent 8 and 255 characters";
}
//match the credentails
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();


if(!empty($errors)){
    return view('sessions/create.view',[
        'heading' => 'login',
        'errors' => $errors,
    ]);
}

if(!$user){
    return view('sessions/create',[
        'heading' => 'login',
        'errors' => [
            'email' => 'Invalid email'
        ]
    ]);
}

//we have a user, but we don't know if the password provided matches what we have in the database
if(!password_verify($password, $user['password'])){
    return view('sessions/create',[
        'heading' => 'login',
        'errors' => [
            'password' => 'Invalid password'
        ]
        ]);
}

login($user);

header('Location: /notes');
