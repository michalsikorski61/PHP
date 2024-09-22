<?php
    //switch - replacement to using many ifelse statements
    //  more efficient, less code to write

    $grade = 'A';

    switch($grade){
        case 'A':
            echo 'You are a superstar';
            break;
        case 'B':
            echo 'You did great';
            break;
        case 'C':
            echo 'You did okay';
            break;
        case 'D':
            echo 'You did poorly';
            break;
        case 'F':
            echo 'You failed';
            break;
        default:
            echo "{$grade} is not a valid grade";
    }