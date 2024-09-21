<?php
    //if statements - if some condition is true, do something
    // if condition is false, do something else or don't do anything at all
$age = 18;

if($age >= 100){
    echo "You are too old to enter this site";
}elseif($age <= 0){
    echo "That wasn't a valid age";
}elseif($age >= 18){
    echo "You may enter this site";
}else{
    echo "You must be 18 years or older to enter this site";
}