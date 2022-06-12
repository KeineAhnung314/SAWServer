<!DOCTYPE html>
<html lang="de">
<?php
session_start();
error_reporting(0);
require "ac.php";
$ID = $_SESSION['loginID'];
$loc = 8;
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Einzahlungen</title>
</head>

<body>
    <?php require __DIR__ . "/../gov/navbar.php"; ?>
    <div class="main" id="main">

        <h1>Einzahlungen von Echtgeld</h1>

        <form class="transaction" action="/modules/formhandler/inpaymenthandler.php" method="post" target="">

            <input type="Text" name="recID" value="" size="" maxlength="20" required placeholder="Konto des Empfängers" autocomplete="off">
            <br>
            <input type="Text" name="amount" value="" size="" maxlength="20" required placeholder="Eingezahlter Betrag in €" autocomplete="off">

            <br>

            <input class="search" style="margin-left: 0;" type="Submit" name="transaction" value="Einzahlen">

        </form>

        </center>

</body>

</html>