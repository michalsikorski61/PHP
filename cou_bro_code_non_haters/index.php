<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="radio" name="creadit_card" id="credit_card" value="Visa">Visa<br>
        <input type="radio" name="creadit_card" id="credit_card" value="Mastercard">Mastercasr<br>
        <input type="radio" name="creadit_card" id="credit_card" value="American Express">American Exmpress <br>
        <input type="submit" name="confirm" value="Confirm">
    </form>
    <?php
        if(isset($_POST['confirm'])){
            $credit_card = null;
           if(isset($_POST['creadit_card'])){
               $credit_card = $_POST['creadit_card'];
            }

            switch($credit_card){
                case 'Visa':
                    echo 'You have selected Visa';
                    break;
                case 'Mastercard':
                    echo 'You have selected Mastercard';
                    break;
                case 'American Express':
                    echo 'You have selected American Express';
                    break;
                default:
                    echo 'Please select a credit card';
            }
        }

    ?>
</body>
</html>