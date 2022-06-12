<?php
error_reporting(0);
require "ac.php";
require __DIR__ . "/../modules/entlist.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if (!$_SESSION['order']) {
    header("Location: /warehouse/newOrder.php");
    die();
}

$aId = $_POST["id"];
$aId = str_replace(['+', '-'], '', filter_var($aId, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
$val = $_POST[$aId];
if($val == '') $val = 1;
$val = str_replace(['+', '-'], '', filter_var($val, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
$oId = $_SESSION['order'];

require "conn.php";
$sql = "SELECT * FROM orderItem WHERE oid = '$oId' AND aId = '$aId';";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
while ($zeile = mysqli_fetch_assoc($erg)) {
    $oldOId = $zeile['oId'];
    $oldAId = $zeile['aId'];
}
mysqli_free_result($erg);
mysqli_close($db_link);
if (($oId == $oldOId) and ($aId == $oldAId)) {
    require "conn.php";
    $sql = "UPDATE orderItem SET count = count + '$val' WHERE oid = '$oId' AND aId = '$aId';";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    header("Location: /warehouse/product.php?suc=1&val=$val");
} else {
    require "conn.php";
    $sql = "INSERT INTO orderItem (oId,aId,count) VALUES ('$oId','$aId','$val');";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    header("Location: /warehouse/product.php?suc=2&val=$val");
}
