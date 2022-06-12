<?php
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
if (!$_SESSION['order']) {
    header("Location: /warehouse/newOrder.php");
    die();
}
require __DIR__ . "/../lib/orderstate.php";
if(getorderstate($_SESSION['order']) != 'ordering'){
    header("Location: /warehouse/confirm.php?err=1");
    die();
}
require __DIR__ . "/../conn.php";
$sql = "UPDATE orders SET state = 'ordered' WHERE oId = '$_SESSION[order]';";

$erg = mysqli_query($db_link, $sql);
if (!$erg) {
    die("Ungültige Abfrage: " . mysqli_error($db_link));
}
mysqli_free_result($erg);
mysqli_close($db_link);
$_SESSION["order"] = null;
header("Location: /gov/dashboard.php");