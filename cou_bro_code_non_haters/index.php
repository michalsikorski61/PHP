<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkboxes</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="checkbox" name="foods[]" id="pizza" value="Pizza">Pizza<br/>
    <input type="checkbox" name="foods[]" id="hamburger" value="Hamburger">Hamburger<br/>
    <input type="checkbox" name="foods[]" id="hotdog" value="Hotdog">Hotdog<br/>
    <input type="checkbox" name="foods[]" id="taco" value="Taco">Taco<br/>
    <input type="submit" name="submit" value="Ślij">

    </form>
    <?php
        if(isset($_POST['submit'])){
           $foods = $_POST['foods'] ?? false; // foods is an array of selected checkboxes values
           if($foods){
                echo "You selected: <br/>";
                foreach($foods as $food){
                    echo $food . "<br/>";
                }
           }else{
                echo "Please select at least one food";
           }
        }
    ?>
</body>
</html>