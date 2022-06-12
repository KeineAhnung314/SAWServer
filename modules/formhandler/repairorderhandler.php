<?php
    require __DIR__ . "/../ac.php";
    require __DIR__ . "/../lib/editorderview.php";
    if (!$_SESSION['perm']['warehouse']) {
        header("Location: /gov/dashboard.php");
        die();
    }
    if (!$_SESSION['order'] and !$_SESSION['rorder']) {
        header("Location: /gov/dashboard.php");
        die();
    }
    
    $fix = listOrders($_SESSION["rorder"]);
    if($fix['fixable']) {
        require __DIR__ . "/../lib/conn.php";
        $sql = "UPDATE orders SET state = 'ordered' WHERE state = 'cancelled' AND oId = '$_SESSION[rorder]';";
        echo($sql . "<br>");
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrae: " . mysqli_error($db_link));
        }
        mysqli_free_result($erg);
        $sql = "UPDATE orders SET state = 'arrived' WHERE state = 'errored' AND oId = '$_SESSION[rorder]';";
        echo($sql . "<br>");
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrae: " . mysqli_error($db_link));
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);
        header("Location: /warehouse/watchorders.php?suc=1");
    }
