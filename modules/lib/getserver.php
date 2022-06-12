<?php
function getservername($id)
{
    if(!$id) return array("fName" => "", "lName" => "", "kl" => "",);

    
    require "conn.php";
    $id = mysqli_real_escape_string($db_link, $id);
    $sql = "SELECT officer.id AS 'officerId',fName,lName,kl FROM officer JOIN citizen ON officer.cId = citizen.id WHERE officer.id = '$id'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $vName =  $zeile['fName'];
        $lName = $zeile['lName'];
        $kl = $zeile['kl'];
    }
    return array("fName" => $vName, "lName" => $lName, "kl" => $kl,);
}
?>