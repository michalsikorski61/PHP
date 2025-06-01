<?php

namespace Core;

class Session{
    public static function has($key){
        
        return (bool) static::get($key);
    }
    public static function put($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null){
        // if(isset($_SESSION['_flash'][$key])){
        //     return  $_SESSION['_flash'][$key];
        // }
        // return $_SESSION[$key] ?? $default;     
        /*
        orher way to write the above code
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
        */
    }

    public static function flash($key,$value){
        
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash($key){
        unset($_SESSION['_flash'][$key]);
    }

    public static function flush(){
        $_SESSION = [];
    }

    public static function destroy(){
        static::flush();
        session_destroy();
        //cookie params
        $cookieParams = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600,$cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
    }
}