<?php
    //associative array - an array made of key-value pairs

    //countries => capitals
    //id => name
    //item => price

    $capitals =[
        "USA" => "Washington DC",
        "Japan" => "Kyoto",
        "South Korea" => "Seoul",
        "India" => "New Delhi",
    ];

    $capitals["China"] = "Beijing";
    $capitals["USA"] = "Las Vegas";
    array_pop($capitals);//remove the last element
    array_shift($capitals);//remove the first element
    unset($capitals["South Korea"]);//remove a specific element
    $keys = array_keys($capitals);//get all the keys
    $values = array_values($capitals);//get all the values
    $flipped_capitals = array_flip($capitals);//flip the keys and values return new array

    $num_rows = count($capitals);//get the number of rows
    $capital_reversed = array_reverse($capitals);//reverse the array return new array
    foreach($capitals as $key => $value){
        echo "{$key} => {$value} <br>";
    };
    echo "<br>Keys: <br>";
    foreach($keys as $key){
        echo "{$key} <br>";
    }
    echo "<br>Values: <br>";
    foreach($values as $value){
        echo "{$value} <br>";
    }

    echo "<br>Flipped Capitals: <br>";
    foreach($flipped_capitals as $key => $value){
        echo "{$key} => {$value} <br>";
    }

    echo "<br>Reversed Capitals: <br>";
    foreach($capital_reversed as $key => $value){
        echo "{$key} => {$value} <br>";
    }