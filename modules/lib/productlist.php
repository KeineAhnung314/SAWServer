<?php
function listallproduct($filter,$button,$field) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT * FROM article WHERE name LIKE '%$filter%' AND available = 1;";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $even = true;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo( "<tr class=\"button ");
            if ($even == 0) echo('even ');
            else echo('odd ');
            echo("\">");
            if($button == 2) echo("<td><button value=\"$zeile[artId]\" name=\"id\">-</button></td>");
            echo("<td>$zeile[name]</td>");
            echo("<td>$zeile[price]</td>");
            if($button == 1) echo("<td><button value=\"$zeile[artId]\" name=\"id\">+</button></td>");
            if($field == 1) echo("<td><input type=\"number\" name=\"$zeile[artId]\" value=\"1\"></td>");
            echo("</tr>");
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
function listallordered($id,$button) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT DISTINCT count,name,price FROM orderItem JOIN article ON aId = artId WHERE oId = '$id';";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            echo("<tr>");
            echo("<td>$zeile[count]</td>");
            echo("<td>$zeile[name]</td>");
            echo("<td>$zeile[price]</td>");
            if($button == 1) echo("<td><button value=\"$zeile[artId]\" name=\"id\">+</button></td>");
            if($button == 1) echo("<td><input type=\"number\" name=\"$zeile[artId]\" value=\"1\"></td>");
            echo("</tr>");
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
function listallorderview($id,$button) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT DISTINCT article.available,count,name,price,aId FROM orderItem JOIN article ON aId = artId WHERE oId = '$id';";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $totprice = 0;
        $even = true;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo("<tr class=\"button ");
            if($even == 0) echo('even');
            else echo('odd');
            if($zeile['available'] == 0) echo(' error');
            echo("\">");
            if($button == 1) echo("<td><button value=\"$zeile[aId]\" name=\"id\">X</button></td>");
            echo("<td>$zeile[count]</td>");
            echo("<td>$zeile[name]</td>");
            echo("<td>$zeile[price]</td>");
            $price = $zeile["count"] * $zeile["price"];
            echo("<td>$price</td>");
            echo("</tr>");
            $totprice = $totprice + $price;
        }
        echo("<h3>Summe: $totprice</h3>");
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
function getorderer($id) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT name FROM orders JOIN enterprise ON cId = id WHERE oId = '$id';";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $name = $zeile['name'];
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
        return $name;
}
function listglobalorderview($filter, $box) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    $sql = "SELECT article.available,article.name,article.price,aId,SUM(count) AS count FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId WHERE orders.state = '$filter' GROUP BY aId;";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $totprice = 0;
        $even = TRUE;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo("<tr class=\"");
            if($even == 0) echo('even');
            else echo('odd');
            if($zeile['available'] == 0) echo(' error');
            echo("\">");
            if($box == 1) echo("<td>&nbsp;</td>");
            echo("<td>$zeile[count]</td>");
            echo("<td>$zeile[name]</td>");
            echo("<td>$zeile[price]</td>");
            $price = $zeile["count"] * $zeile["price"];
            echo("<td>$price</td>");
            echo("</tr>");
            $totprice = $totprice + $price;
        }
        echo("<h3>Summe: $totprice</h3>");
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
function listglobalorder($filter) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    if($filter == '') $sql = "SELECT DISTINCT orders.oId,orders.payed,orders.date,orders.state,enterprise.name,SUM(article.available = 0) AS 'err' FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId JOIN enterprise ON orders.cId = enterprise.id GROUP BY orders.oId";
    else $sql = "SELECT DISTINCT orders.oId,orders.payed,orders.date,orders.state,enterprise.name,SUM(article.available = 0) AS 'err' FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId JOIN enterprise ON orders.cId = enterprise.id WHERE orders.oId = '$filter' OR enterprise.name LIKE '%$filter%' GROUP BY orders.oId";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $even = TRUE;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo("<tr class=\"button ");
            if($even == 0) echo('even');
            else echo('odd');
            if($zeile['err'] > 0) echo(' error');
            echo("\">");
            // if($box == 1) echo("<td>&nbsp;</td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[oId]</button></td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[name]</button></td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">");
            if($zeile['payed']) echo("Ja");
            else echo("Nein");
            echo('</button></td>');
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[state]</button></td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[date]</button></td>");
            echo("</tr>");
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
function listglobalorderarrived($filter) {
    require "conn.php";
    $filter = mysqli_real_escape_string($db_link,$filter);
    if($filter == '') $sql = "SELECT DISTINCT orders.oId,orders.date,enterprise.name,SUM(article.available = 0) AS 'err' FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId JOIN enterprise ON orders.cId = enterprise.id WHERE orders.state = 'arrived' AND orders.payed = 1 GROUP BY orders.oId";
    else $sql = "SELECT DISTINCT orders.oId,orders.date,enterprise.name,SUM(article.available = 0) AS 'err' FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId JOIN enterprise ON orders.cId = enterprise.id WHERE orders.state = 'arrived' AND orders.payed = 1 AND  orders.oId = '$filter' OR enterprise.name LIKE '%$filter%' GROUP BY orders.oId";
    $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $even = TRUE;
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $even = !$even;
            echo("<tr class=\"button ");
            if($even == 0) echo('even');
            else echo('odd');
            if($zeile['err'] > 0) echo(' error');
            echo("\">");
            // if($box == 1) echo("<td>&nbsp;</td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[oId]</button></td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[name]</button></td>");
            echo("<td><button value=\"$zeile[oId]\" name=\"id\">$zeile[date]</button></td>");
            echo("</tr>");
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
?>
