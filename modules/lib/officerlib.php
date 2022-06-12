<?php

function listAllOfficers(){
    require "conn.php";
    $sql = "SELECT officer.id,citizen.fName,citizen.lName,citizen.kl,warehouse,bank,toll FROM officer JOIN citizen ON citizen.id = officer.cId WHERE officer.id != $_SESSION[loginID]";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        $table = $table . "<tr class=\"";
        if ($even == 0) $table = $table . 'even';
        else $table = $table . 'odd';
        $table = $table . "\">";
        $table = $table . "<td>$zeile[id]</td>";
        $table = $table . "<td>$zeile[fName]</td>";
        $table = $table . "<td>$zeile[lName]</td>";
        $table = $table . "<td>$zeile[kl]</td>";
        $table = $table . "<td><table><tr>";
        if($zeile["warehouse"]){
            $table = $table . "<td>✓</td>";
        }else{
            $table = $table . "<td>X</td>";
        }
        if($zeile["bank"]){
            $table = $table . "<td>✓</td>";
        }else{
            $table = $table . "<td>X</td>";
        }
        if($zeile["toll"]){
            $table = $table . "<td>✓</td>";
        }else{
            $table = $table . "<td>X</td>";
        }
        $table = $table . "</tr></table><td>";
        $table = $table . "</tr>";
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    return $table;
}



?>