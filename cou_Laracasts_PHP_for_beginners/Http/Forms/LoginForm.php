<?php

namespace Http\Forms;

use Core\Validator;
class LoginForm{
    protected $errors = [];
    public function validate($email, $password){
        

        if(!Validator::email($email)){
            $this->errors['email'] = "Please enter a valid email address";
        }

        if(!Validator::string($password, 8,255)){
            $this->errors['password'] = "Please enter a password betweent 8 and 255 characters";
        }
       


        // if(!empty($errors)){
        //     return view('session/create.view',[
        //         'heading' => 'login',
        //         'errors' => $errors,
        //     ]);
        // }
        return empty($this->errors);
    }

    public function errors(){
        return $this->errors;
    }


    public function error($field, $message){
        $this->errors[$field] = $message;
    }
}