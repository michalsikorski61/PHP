<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

// log in the usr if the creadentials are correct
$db = App::resolve(Database::class);
//check form is valid
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if(!$form->validate($email, $password)){
    return view('session/create',[
        'heading' => 'login',
        'errors' => $form->errors(),
    ]);
}
// $errors = [];

// if(!Validator::email($email)){
//     $errors['email'] = "Please enter a valid email address";
// }

// if(!Validator::string($password, )){
//     $errors['password'] = "Please enter a password betweent 8 and 255 characters";
// }
// //match the credentails
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();


// if(!empty($errors)){
//     
// }

if($user){
    if(password_verify($password, $user['password'])){
    login($user);

    header('Location: /notes');
    exit();
    }
}


return view('session/create',[
    'heading' => 'login error',
    'errors' => [
        'email' => 'Invalid credentials'
    ]
    ]);