<?php
    echo($_POST["sid"]);
    echo($_POST["recid"]);
    echo($_POST["passwd"]);
    $pw = $_POST["passwd"];
    $hashPassword = hash("sha256", $pw);  //hash value aus Datenbank abfragen
    $recid = $_POST['recid'];
    $recid = str_replace(['+', '-'], '', filter_var($recid, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
    $sid = $_POST['sid'];
    $sid = str_replace(['+', '-'], '', filter_var($sid, FILTER_SANITIZE_NUMBER_INT)); //sanitize input
    $price = $_POST['value'];
    $price = str_replace([','],'.',$price);
    $price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 

    $getargs = "/transaction/transactiondialogpupup.php?id=$recid&sid=$sid&val=$price";
    require "conn.php";

    if (strlen($id) == 6) {
        //Bürger
        $sql = "SELECT * FROM citizen WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["passwd"];
        }

        mysqli_free_result($erg);
        mysqli_close($db_link);

        if ($password == $hashPassword) {
            //Erfolgreich angemeldet 
//ERFOLG
        } else {
//FEHLER            
            header("Location: $getargs&err=1");
        }
    } else if (strlen($id) == 4) {
        //Betriebe (inklusive zoll, Bank)
        $sql = "SELECT * FROM enterprise WHERE id = '$id'";
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        }
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $password = $zeile["pw"];
        }

        mysqli_free_result($erg);
        mysqli_close($db_link);


        if ($password == $hashPassword) {
//ERFOLG
        } else {
//FEHLER
            header("Location: $getargs&err=1");
        }
    } else 
//UNGÜLTIGE ID    
        header("Location: $getargs/?err=2");
    }
?>