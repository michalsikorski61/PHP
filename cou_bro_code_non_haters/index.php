<?php
    // cookie - info about a usr stored in a usr's web browser
    // targeted ads, browser's preferences, 
    // and other non-sensitive data
    setcookie('fav_food','pizza',time() + 86400,'/'); // 1 day');
    setcookie('fav_drink','coffee',time() + (86400*3),'/');
    setcookie('fav_dessert','ice cream',time() + (86400*7),'/');

    //read 
    foreach($_COOKIE as $key => $value){
        echo $key . ' => ' . $value . '<br>';
    }

    if(isset($_COOKIE['fav_food'])){
        echo "BOY SOME {$_COOKIE['fav_food']}! <br>"; 
    }else{
        echo "I don't know your fav food <br>";
    }

    //delete cookie
    // setcookie('fav_drink','coffee',time() - 0,'/');
    setcookie('fav_food','pizza',time() - 0,'/');
    // setcookie('fav_dessert','ice cream',time() - 0,'/');

