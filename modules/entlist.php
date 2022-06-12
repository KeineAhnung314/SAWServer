<?php
function listallent($filter,$button) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT * FROM enterprise WHERE name LIKE '%$filter%'";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $even = true;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo( "<tr class=\"");
            if ($even == 0) echo('even ');
            else echo('odd ');
            if($button) echo('button');
            echo("\">");

            if($button == 1){
                echo("<td><button value=\"$zeile[id]\" name=\"id\">$zeile[name]</button></td>");
                echo("<td><button value=\"$zeile[id]\" name=\"id\">$zeile[id]</button></td>");
            }else{
                echo("<td>$zeile[name]</td>");
            echo("<td>$zeile[id]</td>");
            } 
            echo("</tr>");
        }

}


