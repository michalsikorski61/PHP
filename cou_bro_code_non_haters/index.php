<?php 
    // logical operators - combine conditional statements
    // if(condition1 && condition2) - both conditions must be true

    // && - true if both conditions are true. False if either one is false
    // || - true if either condition is true. False if both are false
    // ! - true if condition is false. false if condition is true
$age = 19;
$citizen = false;

if(!$age >= 18 || !$citizen){
    echo "You cannot vote";
}else{
    echo "You can vote";
}
echo "<br>Sell movie tickets<br>";
$child = false;
$senior = false;
$ticket = null;

if($child || $senior){
    $ticket = 10;
}else{
    $ticket = 15;
}
echo "Ticket price: \${$ticket}";