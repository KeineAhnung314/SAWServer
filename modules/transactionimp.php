<?php 

function send($sendId, $value)
{
//Sender Kontostand anpassen 

    require "conn.php";
    $sql = "SELECT balance FROM bankaccount WHERE id = '$sendId'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    } 
    
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $balance =  $zeile["balance"];
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);

    $balance = $balance - $value; 

    require "conn.php";
    $sql = "UPDATE bankaccount SET balance = '$balance' WHERE id = '$sendId'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_close($db_link);
    
}


function receive($recId, $value)
{
//Empfänger Kontostand anpassen

    require "conn.php";
    $sql = "SELECT balance FROM bankaccount WHERE id = '$recId'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    } 
    
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $balance =  $zeile["balance"];
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);

    $balance = $balance + $value; 

    require "conn.php";
    $sql = "UPDATE bankaccount SET balance = '$balance' WHERE id = '$recId'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    
    mysqli_close($db_link);
    
}


function transfer($sendId, $recId, $value, $txtL, $txtR, $taxVal)
{
//transfer tabelle anpassen 

    require "conn.php";
    $sql = "INSERT INTO transfer(val, txtL, txtR, sendId, recId, taxVal) VALUES('$value','$txtL','$txtR','$sendId','$recId','$taxVal')";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }

    mysqli_close($db_link);
    
}