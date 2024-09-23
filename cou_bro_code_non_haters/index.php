<?php 
    //arrays - "variable" that holds multiple values at a time
    $food_1 = "Pasta";
    $food_2 = "Pizza";
    $food_3 = "Burger";
    $food_4 = "Fries";

    $foods = array("Pasta", "Pizza", "Burger", "Fries");
    // or you can use the shorthand version of array declaration this is
    // called "short array syntax" - ['value1', 'value2', 'value3']
    // $foods = ["Pasta", "Pizza", "Burger", "Fries"];
    // echo $foods[0]; // Pasta
    echo $foods[0]; // Pasta
    echo $foods[1]; // Pizza
    echo $foods[2]; // Burger
    echo $foods[3]; // Fries
    // echo $foods[4]; // Error: Undefined offset: 4
    $foods[0] = "Pineapple";
    array_push($foods, "Pasta", "Ice Cream", "Candy");
    array_pop($foods); // removes the last element of the array
    array_shift($foods); // removes the first element of the array
    echo "<br><h1>Better way to print array values</h1><br>";
    foreach($foods as $food){
        echo $food . "<br>";
    }
    echo "<br><h1>Reversed Array</h1><br>";
    //reversed array
    $reversed_foods = array_reverse($foods);
    foreach($reversed_foods as $food){
        echo $food . "<br>";
    }

    
    echo "count: ". count($foods);