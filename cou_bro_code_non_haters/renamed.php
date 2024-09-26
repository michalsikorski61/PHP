<?php
//hashing - transforming sensitive data (password)
// into letters, numbers and/or symbols
// via a math process. (similar to encryption)
// hides orginal data from 3rd parties
$password = 'pizza123';
$hash = password_hash($password, PASSWORD_DEFAULT);
if(password_verify($password, $hash)){
    echo 'Password is valid';
}else{
    echo 'Password is invalid';
}