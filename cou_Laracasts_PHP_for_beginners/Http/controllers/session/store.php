<?php

use Core\Authenticator;
use Core\Session;
use Core\Validator;
use Http\Forms\LoginForm;

// log in the usr if the creadentials are correct

$errors = [];
//check form is valid
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if(!Validator::string($password,20,255)){
    $errors['password'] = "Please enter a password between 2 and 255 characters";
}
if(!Validator::email($email)){  
    $errors['email'] = "Please enter a valid email address";
}
if($form->validate($email, $password)){
    
    $auth = new Authenticator();
    if($auth->attempt($email, $password)){
       redirect('/');
    }else{
        $form->error('email', 'The provided credentials do not match our records.');
    }
}

Session::flash('errors', $form->errors());
//we need to store the old input so that we can repopulate the form because post data is not available after a redirect
Session::flash('old', [
    'email' => $_POST['email'],
]);
return redirect('/login');




