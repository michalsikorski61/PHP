<?php

use Core\Authenticator;
use Http\Forms\LoginForm;


$form = LoginForm::validate($attributes = [
'email' => $_POST['email'],
'password' => $_POST['password'],
]);

// Attempt to sign in the user with the provided credentials
$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);


// Check if the login attempt was successful
if(!$signedIn) {
    // If the login attempt failed, add an error to the form
    $form->error('email', 'The provided credentials do not match our records.')->throw();
}

// If the login attempt was successful, redirect to the home page
redirect('/');



