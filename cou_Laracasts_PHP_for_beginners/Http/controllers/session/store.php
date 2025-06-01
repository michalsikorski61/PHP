<?php

use Core\Authenticator;
use Core\Session;
use Core\Validator;
use Http\Forms\LoginForm;

// log in the usr if the creadentials are correct

$errors = [];
//check form is valid


$form = LoginForm::validate([
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);
    
$auth = new Authenticator();
if($auth->attempt($email, $password)){
    redirect('/');
}else{
    $form->error('email', 'The provided credentials do not match our records.');
}


Session::flash('errors', $form->errors());
//we need to store the old input so that we can repopulate the form because post data is not available after a redirect
Session::flash('old', [
    'email' => $_POST['email'],
]);
return redirect('/login');




