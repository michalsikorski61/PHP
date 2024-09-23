<?php
    // isset() - returns true if variable is set and not null
    // empty() - returns true if variable is empty, not declared, null, ""

    $usr = "Michalski9";
    if(isset($usr)){
        echo "User is set";
    } else {
        echo "User is not set";
    }

    echo "<br>";
    if(empty($usr)){
        echo "User is empty";
    } else {
        echo "User is not empty";
    }