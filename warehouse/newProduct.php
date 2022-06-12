<!DOCTYPE html>
<html lang="de">
<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/entlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neues Produkt hinzufügen</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <a href="/warehouse/productoverview.php">Zurück</a>
    <h1>Neues Produkt hinzufügen</h1>
    <form action="/modules/formhandler/newproducthandler.php" method="post">
    <?php
            if($_GET['err'] == 1) echo("<div class=\"loginerr\">Produktname muss zwischen 4 und 40 Zeichen lang sein</div>");
            if($_GET['err'] == 2) echo("<div class=\"loginerr\">Preis muss größer als 0 sein</div>");
            if($_GET['err'] == 3) echo("<div class=\"loginerr\">Zugriff verweigert!</div>");
            if($_GET['suc'] == 1) echo("<div class=\"logout\">\"$_GET[name]\" wurde erfolgreich zum Sortiment hinzugefügt</div>");
        ?>
        <p>Name, Preis</p>
        <input type="text" name="pname" required>
        <input type="float" name="price" step="0.01" required>
        <input type="submit" value="+">
    </form>
   
    </form>
</body>

</html>