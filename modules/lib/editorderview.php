<?php
function listOrders($id,$x = true)
{
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link, $filter);
    $sql = "SELECT DISTINCT article.available,count,name,price,aId,state FROM orderItem JOIN article ON aId = artId JOIN orders ON orders.oId = orderItem.oId WHERE orders.oId = '$id'";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    $totprice = 0;
    $even = true;
    $table = "";
    $fixable = true;
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        $table = $table . "<tr class=\"";
        if ($even == 0) $table = $table . 'even';
        else $table = $table . 'odd';
        if ($zeile['available'] == 0) {
            $table = $table . ' error button';
            $fixable = FALSE;
        }
        if(!($zeile['state'] == 'cancelled' OR $zeile['state'] == 'errored')) $fixable = false;
        $table = $table . "\">";
        if($x) {
            if ($zeile['available'] == 0 or $zeile["state"] == 'cancelled') $table = $table . "<td><button value=\"$zeile[aId]\" name=\"id\">X</button></td>";
        else $table = $table . "<td>&nbsp;</td>";
        }
        $table = $table . "<td>$zeile[count]</td>";
        $table = $table . "<td>$zeile[name]</td>";
        $table = $table . "<td>$zeile[price]</td>";
        $price = $zeile["count"] * $zeile["price"];
        $table = $table . "<td>$price</td>";
    
        $table = $table . "</tr>";
        $totprice = $totprice + $price;
    }

    mysqli_free_result($erg);
    mysqli_close($db_link);
    return array("table" => $table, "fixable" => $fixable, "sum" => $totprice);
}
