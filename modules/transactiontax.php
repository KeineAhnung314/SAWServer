<?php

function taxCheck($id)
{
//Prüfen, ob Steuern fällig sind

    if (strlen($id) == 4) {
        //Steuern fällig, da Gewerbe
        
        require "conn.php";
        $sql = "SELECT tax FROM enterprise WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        } 
        
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $result = $zeile["tax"];
        }
        
        mysqli_free_result($erg);
        mysqli_close($db_link);
         
    } 

    return $result;

}


function taxValue($value, $tax)
{
//Steuer Wert berechnen 

    $taxval = $value - ($value /(1 + $tax)); 

    return $taxval;

    
    
}