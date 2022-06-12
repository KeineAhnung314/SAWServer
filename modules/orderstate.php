<?php 

function statepayed($cId)
{

    require "conn.php";
    $sql = "UPDATE orders SET payed = '1' WHERE cId = '$cId'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    
    mysqli_close($db_link);


}