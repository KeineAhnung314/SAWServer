<?php
function getorderstate($id)
{
    require __DIR__ . "/../conn.php";
    $filter = mysqli_real_escape_string($db_link, $filter);
    $sql = "SELECT SUM(article.available = 0) AS count FROM `orderItem` JOIN article ON orderItem.aId = article.artId JOIN orders on orderItem.oId = orders.oId WHERE orders.oId = '$id' GROUP BY article.available;";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        if ($zeile['count'] > 0) {
            mysqli_free_result($erg);
            mysqli_close($db_link);
            return 'error';
        }
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    require __DIR__ . "/../conn.php";
    $sql = "SELECT orders.state FROM orders WHERE orders.oId = '$id';";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $stat = $zeile['state'];
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    return $stat;
}
