<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="country">Enter a country:</label>
        <input type="text" name="country" id="country">
        <input type="submit" value="Submit">
    </form>
    <?php
        $capitals =[
            "USA" => "Washington D.C.",
            "Nigeria" => "Abuja",
            "Ghana" => "Accra",
            "Kenya" => "Nairobi",
            "South Africa" => "Cape Town",
            "Rwanda" => "Kigali",
        ];
        $capitals = array_flip($capitals); 
        
        //  if(array_search($_POST['country'], $capitals)){
        //     echo "The capital of " . $_POST['country'] . " is " . $capitals[$_POST['country']];
        //  }else{
        //     echo "The country you entered is not in the list";
        //  }
        $result = array_search($_POST['country'], $capitals);
        if($result){
            echo "The capital of " . $_POST['country'] . " is " . $result;
        }else{
            echo "The country you entered is not in the list";
        }
        ?>
</body>
</html>