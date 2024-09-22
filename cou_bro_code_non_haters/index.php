<?php 
    // logical operators - combine conditional statements
    // if(condition1 && condition2) - both conditions must be true

    // && - true if both conditions are true. False if either one is false
    // || - true if either condition is true. False if both are false
    // ! - true if condition is false. false if condition is true
$temp_celcius = -100;
$claudy = true;

if($temp_celcius < 0 || $temp_celcius > 30){
    echo "The weather is bad<br>";
}else{
    echo "The weather is good<br>";
}

if(!$claudy){
    echo "Its sunny";
}else{
    echo "Its claudy";
}