<?php
error_reporting(0);
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}

$_SESSION['rorder'] = $_POST['id'];
header("Location: /warehouse/collectorder.php");
?>

