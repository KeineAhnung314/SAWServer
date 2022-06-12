<!DOCTYPE html>
<html lang="de">
<?php
session_start();
error_reporting(0);
require "ac.php";
$ID = $_SESSION['loginID'];
$loc = "1";
require __DIR__ . "/../modules/lib/themehelper.php";
$theme = getTheme();
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neue Überweisung</title>
    <link rel="stylesheet" href="<?php echo ($theme) ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php require "navbar.php"; ?>
    <div class="main" id="main">

        <h1>Neue Überweisung</h1>


        <form action="/modules/transactionhandler.php" method="post" target="" class="transaction">
            <input autocomplete="off" type="Text" name="recID" placeholder="Empfänger-ID" size="" maxlength="20" required>
            <br>
            <input autocomplete="off" type="Text" class="money" name="amount" placeholder="Betrag" maxlength="20" required> <span>GC</span>
            <br>
            <input autocomplete="off" type="Text" placeholder="Verwendungszweck 1" name="txtL" value="" size="" maxlength="20" required>
            <input autocomplete="off" type="Text" placeholder="Verwendungszweck 2" name="txtR" value="" size="" maxlength="20">
            <br>
            <input type="hidden" name="sendId" value="<?php echo $_SESSION['loginID'] ?>">
            <input type="hidden" name="target" value="/my/dashboard.php">

            <input class="submit" type="Submit" name="transaction" value="Überweisen">

        </form>


    </div>
</body>

</html>