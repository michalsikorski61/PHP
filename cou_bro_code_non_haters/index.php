<?php
    //variable - a reusable container that holds a data,
    //      string, number, array, object, function, etc.
//str
$name = 'Michal Kowalski';
$food = 'pizza';
$email = 'fake123@gmail.com';
//int
$age = 21;
$usr_online = 3;
$quantity = 3;
//float
$gpa = 3.5;
$price = 4.99;
$tax_rate = 5.1;

//boolen - true or false
$employed = true;
$online = false;
$for_sale = true;



// echo "Hello {$name}!<br>"; 
// echo "You like {$food}!<br>";
// echo "Your email is {$email}!<br>";
// echo "You are {$age} years old!<br>";
// echo "There are {$usr_online} users online!<br>";
// echo "You would like to buy {$quantity} items!<br>";
// echo "Your GPA is {$gpa}!<br>";
// echo "Your pizza is \${$price}!<br>";
// echo "The sales tax rate is {$tax_rate}%!<br>";
// echo "Online status: {$online}<br>";
$total = null;
echo "You have ordered {$quantity} x {$food}!<br>";
$total = $quantity * $price;
echo "Your total is \${$total}!<br>";

?>