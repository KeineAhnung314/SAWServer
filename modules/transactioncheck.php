<?php

function recCheck($id)
{
//Prüfen, ob Empfänger existiert

    require "conn.php";
    $sql = "SELECT COUNT(id) FROM bankaccount WHERE id = '$id'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    } 
    
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $result =  $zeile["COUNT(id)"];
    }

    if ($result == 1) {
        $return = "okay"; 
    } else {
        $return = "error"; 
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);

    return $return; 
    
}

function sendCheck($id, $value)
{
//Prüfen, ob Sender genug Geld auf dem Konto hat existiert

    require "conn.php";
    $sql = "SELECT balance FROM bankaccount WHERE id = '$id'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    } 
    
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $result =  $zeile["balance"];
    }

    if ($result <= 0) {
        $return = "error"; 
    } else {
        $return = "okay"; 
    }

    if ($result < $value) {
        $return = "error"; 
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);

    return $return; 
    
}


function valueCheck($value)
{
//Prüfen, ob Wert positiv ist

    if ($value <= 0) {
        $return = "error"; 
    } else {
        $return = "okay"; 
    }

    return $return; 
    
}


function recsendChek($sendId, $recId)
{
//Prüfen, ob Sender genug Geld auf dem Konto hat existiert

    if ($sendId == $recId) {
        $return = "error"; 
    } else {
        $return = "okay"; 
    }

    return $return; 
    
}

