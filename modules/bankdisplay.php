<?php
require "ac.php";
function transrec()
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT * FROM transfer WHERE recId = '$id' ORDER BY date DESC";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    $even = true;
    echo ("<table><tr><th>Datum</th><th>Sender</th><th>Zweck</th><th>&nbsp</th><th>Betrag</th><th>davon Steuern</th></tr>");
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        echo("<tr class=\"");
        if ($even == 0) echo('even">');
        else echo('odd">');
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[recId]</td>");
        echo ("<td>$zeile[txtL]</td>");
        echo ("<td>$zeile[txtR]</td>");
        echo ("<td>$zeile[val]</td>");
        echo ("<td>$zeile[taxVal]</td>");
        echo ("</tr>");
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("</table>");
}

function transsend()
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT * FROM transfer WHERE sendId = '$id' ORDER BY date DESC";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    echo ("<table><tr><th>Datum</th><th>Empfänger</th><th>Zweck</th><th>&nbsp</th><th>Betrag</th><th>davon Steuern</th></tr>");
    $even = true;
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        echo("<tr class=\"");
        if ($even == 0) echo('even">');
        else echo('odd">');
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[recId]</td>");
        echo ("<td>$zeile[txtL]</td>");
        echo ("<td>$zeile[txtR]</td>");
        echo ("<td>$zeile[val]</td>");
        echo ("<td>$zeile[taxVal]</td>");
        echo ("</tr>");
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("</table>");
}
function transall()
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT * FROM transfer WHERE sendId = '$id' OR recId = '$id' ORDER BY date DESC";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    echo ("<table><tr><th>Datum</th><th>Sender</th><th>Empfänger</th><th>Zweck</th><th>&nbsp</th><th>Betrag</th><th>davon Steuern</th></tr>");
    $even = true;
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        echo("<tr class=\"");
        if ($even == 0) echo('even">');
        else echo('odd">');
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[sendId]</td>");
        echo ("<td>$zeile[recId]</td>");
        echo ("<td>$zeile[txtL]</td>");
        echo ("<td>$zeile[txtR]</td>");
        echo ("<td>$zeile[val]</td>");
        echo ("<td>$zeile[taxVal]</td>");
        echo ("</tr>");
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("</table>");
}
function transglobal()
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT * FROM transfer ORDER BY date DESC";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    echo ("<table><tr><th>Datum</th><th>Sender</th><th>Empfänger</th><th>Zweck</th><th>&nbsp</th><th>Betrag</th><th>davon Steuern</th></tr>");
    $even = true;
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $even = !$even;
        echo( "<tr class=\"");
        if ($even == 0) echo('even ');
        else echo('odd ');
        echo("\">");
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[sendId]</td>");
        echo ("<td>$zeile[recId]</td>");
        echo ("<td>$zeile[txtL]</td>");
        echo ("<td>$zeile[txtR]</td>");
        echo ("<td>$zeile[val]</td>");
        echo ("<td>$zeile[taxVal]</td>");
        echo ("</tr>");
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("</table>");
}
function getBal() {
    require "conn.php";
        $id = $_SESSION['loginID'];
        $sql = "SELECT * FROM bankaccount WHERE id = '$id';";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $balance = $zeile["balance"];
        }
        echo($balance . " GC");
        mysqli_free_result($erg);
        mysqli_close($db_link);
}
