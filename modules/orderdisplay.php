<?php
require "ac.php";
session_start();

function detail($oId)
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT * FROM orders JOIN orderItem ON orderItem.oId = orders.oId JOIN article ON article.artId = orderItem.aId WHERE cId = '$id' AND orders.oId = '$oId'ORDER BY date DESC";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    echo ("<table><tr><th>Datum</th><th>Zustand</th><th>Artikelnummer</th><th>Artikelname</th><th>Menge</th><th>Gesamtpreis des Artikels</th></tr>");
    while ($zeile = mysqli_fetch_assoc($erg)) {
        echo ("<tr>");
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[state]</td>");
        echo ("<td>$zeile[aId]</td>");
        echo ("<td>$zeile[name]</td>");
        echo ("<td>$zeile[count]</td>");

        $prize = $zeile[count] * $zeile[price]; 
        echo ("<td>$prize</td>");
        $totalprize = $totalprize + $prize; 
        echo ("</tr>");

        $payed = $zeile[payed]; 
        $state = $zeile[state]; 
    }

    echo ("</table>");
    echo "<br>"; 

    if ($payed == 0) {
        echo ("Bezahlung ausstehend");
    }else{
        echo ("Bezahlung abgeschlossen");
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);
    

    echo "<br>"; 
    echo "Summe: ".$totalprize." GC";
    $_SESSION ['total'] = $totalprize; 


    if ($payed == 0 && $state == "arrived") {
            ?> 

            <form action="/modules/payorder.php" method="post" target="">

                <input type="hidden" name="recID" value="1000">
                <input type="hidden" name="txtL" value="Bezahlung">
                <input type="hidden" name="txtR" value="Waren">
                <input type="hidden" name="amount" value="<?php echo $_SESSION ['total']?>">
                <input type="hidden" name="sendId" value="<?php echo $_SESSION ['loginID']?>">
                <input type="hidden" name="target" value="/ent/dashboard.php">
            
                <input type="Submit" name="transaction" value="bezahlen">

            </form>

            <?php
    } 
}



function ordersoverview()
{
    require "conn.php";
    $id = $_SESSION['loginID'];
    $sql = "SELECT DISTINCT orders.oId, orders.state, payed, orders.date FROM orders JOIN orderItem ON orderItem.oId = orders.oId JOIN article ON article.artId = orderItem.aId WHERE orders.cId = '$id'";  //
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    echo ("<table><tr><th>Bestellnummer</th><th>Datum</th><th>Zustand</th><th>Bezahlstatus</th><th>Bearbeiten</th></tr>");
    while ($zeile = mysqli_fetch_assoc($erg)) {
        echo ("<tr>");
        echo ("<td>$zeile[oId]</td>");
        echo ("<td>$zeile[date]</td>");
        echo ("<td>$zeile[state]</td>");
        if ($zeile[payed] == 0) {
            echo ("<td>Bezahlung ausstehend</td>");
        }else{
            echo ("<td>Bezahlung abgeschlossen</td>");
        }

        ?> 
        <td> <form action="detailorders.php" method="post" target="">
            <input type="hidden" name="oId" value="<?php echo $zeile[oId]?>">

            <input type="Submit" name="transaction" value="Detailansicht">
        </form>
        </td>
        <?php


        echo ("</tr>");
    }
    
    mysqli_free_result($erg);
    mysqli_close($db_link);
    echo ("</table>");

}


