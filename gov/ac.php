<?php
session_start();
error_reporting(0);
if($_SESSION["type"] != "officer"){
    header("Location: /index.php?err=3");
    die();
}
if(!isset($_SESSION['loginID'])){
    header("Location: /index.php?err=2");
    die();
}
?>