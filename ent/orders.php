<!DOCTYPE html>
<html lang="de">
<?php
require "ac.php";
require __DIR__ . "/../modules/orderdisplay.php"
?>
<head>

</head> 

<body> 
    <a href="/ent/dashboard.php">Zurück</a>
    <br> <br> 



    <h1> Übersicht der Bestellungen </h1> 
    <?php ordersoverview()?>

</body> 