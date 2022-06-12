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

        <form action="/ent/transactionkundenid.php" method="post" target="">


            <br>Betrag </br>
            <input type="Text" name="amount" value="" size="" maxlength="20" required>
            <br>

            <br>Verwendungszweck</br>
            <input type="Text" name="txtL" value="" size="" maxlength="20" required>
            <input type="Text" name="txtR" value="" size="" maxlength="20">
            <br>

            <input type="hidden" name="recId" value="<?php echo $_SESSION ['loginID']?>">
            

            <br>
            <br> Indem sie ihre eingabe bestätigen, gelangen sie zu einer Seite, wo der Kunde die Überweisung an sie durchführen kann 
            <br> 

            <input type="Submit" name="transaction" value="Bestätigen">

        </form>

    </center>

</body>

</html>