<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['loginID'])){
    header("Location: /index.php?err=2");
    die();
}
?>