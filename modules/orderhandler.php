<?php
require "ac.php";
require "conn.php";
$id = $_POST['id'];
$id = str_replace(['+', '-'], '', filter_var($id, FILTER_SANITIZE_NUMBER_INT));
$sql = "INSERT INTO orders (cId,offId) VALUES ('$id','$_SESSION[loginID]');";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        $_SESSION["order"] = mysqli_insert_id($db_link);
        mysqli_free_result($erg);
        mysqli_close($db_link);
        header("Location: /warehouse/product.php");

?>