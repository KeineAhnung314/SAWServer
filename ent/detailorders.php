<!DOCTYPE html>
<html lang="de">
<?php

require "ac.php";
require __DIR__ . "/../modules/orderdisplay.php"; 
$ID = $_SESSION['loginID']; 


$oId = $_POST["oId"];


echo '<a href="/ent/orders.php">Zurück</a>'; 
echo '<br> <br>'; 


echo '<h1> Bestellung </h1>'; 
echo "Bestellnummer ".$oId; 
echo '<br> <br>'; 
detail($oId); 
 