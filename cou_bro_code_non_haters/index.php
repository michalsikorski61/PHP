<?php
    //functions - write some code onece, reuse when you need it
    // type () after function name invoke
    // ex. add() subtract() multiply() divide()

    // function is_even($number){
    //     return $number % 2;
        
    // }

    // echo is_even(11); // false

    function hypotenuse(float $a, float $b){
        $c =  sqrt($a**2 + $b**2);
        return $c;
    }

    echo hypotenuse(3, 4); // 5
    echo hypotenuse(4,5); // 6.4031242374328