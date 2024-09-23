<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkboxes</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="checkbox" name="pizza" id="pizza" value="Pizza">Pizza<br/>
    <input type="checkbox" name="hamburger" id="hamburger" value="Hamburger">Hamburger<br/>
    <input type="checkbox" name="hotdog" id="hotdog" value="Hotdog">Hotdog<br/>
    <input type="checkbox" name="taco" id="taco" value="Taco">Taco<br/>
    <input type="submit" name="submit" value="Ślij">

    </form>
    <?php
        if(isset($_POST['submit'])){
            if(isset($_POST['pizza'])){
                echo "You like {$_POST['pizza']}<br/>";
            }
            if(isset($_POST['hamburger'])){
                echo "You like {$_POST['hamburger']}<br/>";
            }
            if(isset($_POST['hotdog'])){
                echo "You like {$_POST['hotdog']}<br/>";
            }
            if(isset($_POST['taco'])){
                echo "You like {$_POST['taco']}<br/>";
            }
            
            if(empty($_POST['pizza'])){
                echo "You DON'T like {$_POST['pizza']}<br/>";
            }
            if(empty($_POST['hamburger'])){
                echo "You DON'T like {$_POST['hamburger']}<br/>";
            }
            if(empty($_POST['hotdog'])){
                echo "You DON'T like {$_POST['hotdog']}<br/>";
            }
            if(empty($_POST['taco'])){
                echo "You DON'T like {$_POST['taco']}<br/>";
            }
        }
    ?>
</body>
</html>