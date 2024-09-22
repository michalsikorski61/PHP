<?php
    //if statements - if some condition is true, do something
    // if condition is false, do something else or don't do anything at all
$hours = 50;
$rate = 15;
$weeklyPay = null;

if($hours <= 0){
    $weeklyPay = 0;
}
elseif($hours <= 40){
    $weeklyPay = $hours * $rate;
}else{
    $weeklyPay = (40 * $rate) + ($hours - 40) * ($rate * 1.5);
}

echo "You made \${$weeklyPay} this week";