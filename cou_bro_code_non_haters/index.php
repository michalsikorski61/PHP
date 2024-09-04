<?php
 //Artmetic operators
 // + - * / % **

 $x = 10;
$y = 2;
$z = null;

$z = $x + $y;
$z = $x - $y;
$z = $x * $y;
$z = $x / $y;
$z = $x ** $y;
$z = $x % $y;
echo $z . "<br>";
 //increment and decrement operators
    //++ --
echo 'increment and decrement operators' . "(counter = 0)<br>";
$counter = 0;
echo '$counter++' . "<br>";
$counter++; //1
echo $counter . "<br>";
echo '++$counter' . "<br>";
++$counter; //2
echo $counter . "<br>";
echo '$counter-=2' . "<br>";
$counter-=2; //0
echo $counter . "<br>";
echo '$counter--' . "<br>";
$counter--; //-1
echo $counter . "<br>";

//operator precedence
// ()
// **
// * / %
// + -
$total = 1 + 2 - 3 * 4 / 5 ** 6;
echo $total . "<br>";
