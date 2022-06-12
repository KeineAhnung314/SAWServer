<!DOCTYPE html>
<html lang="de">
<?php
session_start();
error_reporting(0);
require "ac.php";
$ID = $_SESSION['loginID']; 
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Transaction</title>
</head>

<body>

    

    

        <h1>Transaktionen</h1>

        <a href="/ent/dashboard.php">Zurück</a>

        <form action="/ent/transactionkundenhandler.php" method="post" target="">


            <br>ID </br>
            <input type="Text" name="sendId" value="" size="" maxlength="20" required>
            <br>

            <br>Passwort </br>
            <input type="password" name="PW" value="" size="" maxlength="20" required>
            <br>

            <input type="hidden" name="recId" value="<?php echo $_SESSION ['loginID']?>">
            <input type="hidden" name="txtL" value="<?php echo $_POST["txtL"]?>">
            <input type="hidden" name="txtR" value="<?php echo $_POST['txtR']?>">
            <input type="hidden" name="amount" value="<?php echo $_POST["amount"]?>">
            

            <br>
           

            <input type="Submit" name="transaction" value="Bestätigen">

        </form>

    </center>

</body>

</html>