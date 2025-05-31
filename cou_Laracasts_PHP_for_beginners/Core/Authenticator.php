<?php

namespace Core;

class Authenticator{
    public function attempt($email, $password){
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if($user){
            if(password_verify($password, $user['password'])){
            $this->login($user);

            return true;
            }
        }      
        return false;
    }

    public function login($user){
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $user['id'],
        ];
        session_regenerate_id(true);
    }

    public function logout(){
            //log usr out
        $_SESSION = [];
        session_destroy();
        //cookie params
        $cookieParams = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600,$cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
    }

    


}