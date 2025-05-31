<?php

use Core\Authenticator;
use Core\Validator;
use Http\Forms\LoginForm;

// log in the usr if the creadentials are correct

$errors = [];
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
if(!Validator::string($password, )){
    $errors['password'] = "Please enter a password betweent 8 and 255 characters";
}
if(!Validator::email($email)){  
    $errors['email'] = "Please enter a valid email address";
}

$auth = new Authenticator();
if($auth->attempt($email, $password)){
   redirect('/');
}

$form->error('email', 'The provided credentials do not match our records.');

return view('session/create',[
        'heading' => 'login',
        'errors' => $form->errors(),
    ]); 
//match the credentails


// if(!empty($errors)){
//     
// }




