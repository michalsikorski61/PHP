<?php
    //switch - replacement to using many ifelse statements
    //  more efficient, less code to write

 $date = date('l'); //get the current day of the week
 $date = 'pizza'; //for testing
 switch(ucfirst(strtolower($date))){
    case 'Monday':
        echo 'I hate Mondays';
        break;
    case 'Tuesday':
        echo 'It is Taco Tuesday';
        break;
    case 'Wednesday':
        echo 'The work week is half over';
        break;
    case 'Thursday':
        echo 'The weekend is almost here';
        break;
    case 'Friday':
        echo 'The weekend is here';
        break;
    case 'Saturday':
        echo 'Time to party';
        break;
    case 'Sunday':
        echo 'Time to relax';
        break;
    default:
        echo "{$date} is not a valid day of the week";
        break;
    
 }