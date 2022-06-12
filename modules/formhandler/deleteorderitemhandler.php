<?php
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if (!$_SESSION['order'] and !$_SESSION['rorder']) {
    header("Location: /gov/dashboard.php");
    die();
}
$aId = $_POST['id'];
if ($_SESSION['order']) $oId = $_SESSION['order'];
else $oId = $_SESSION['rorder'];
$aId = str_replace(['+', '-'], '', filter_var($aId, FILTER_SANITIZE_NUMBER_INT));
require __DIR__ . "/../conn.php";
$sql = "DELETE FROM orderItem WHERE oId = $oId AND aId = $aId;";

$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);
require __DIR__ . "/../conn.php";
$sql = "SELECT * FROM orderItem WHERE oId = $oId;";
$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
if (mysqli_num_rows($erg) < 1) {
    mysqli_free_result($erg);
    mysqli_close($db_link);
    require __DIR__ . "/../conn.php";
    $sql = "DELETE FROM orders WHERE oId = $oId";
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);
    header("Location: /warehouse/watchorders.php?err=1");
    exit();
}
mysqli_free_result($erg);
mysqli_close($db_link);
if ($_SESSION['order']) header("Location: /warehouse/confirm.php?suc=$aId&val=$oId");
else header("Location: /warehouse/editorder.php?suc=$aId&val=$oId");
