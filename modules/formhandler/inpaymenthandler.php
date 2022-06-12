<?php
error_reporting(0);
require __DIR__ . "/../ac.php";
if (!$_SESSION['perm']['bank']) {
    header("Location: /gov/dashboard.php");
    die();
}


$amount = $_POST["amount"];
$recID = $_POST['recID'];

    


    //prüfen ob Überweisung an sich selbst 
    require __DIR__ . "/../conn.php";

    $sql = "SELECT cid FROM officer WHERE id = '$_SESSION[loginID]' "; 
    $erg = mysqli_query($db_link, $sql);
    if (!$erg) {
        die("Ungültige Abfrage: " . mysqli_error($db_link));
    } 
    
    while ($zeile = mysqli_fetch_assoc($erg)) {
        $result =  $zeile["cid"];
    }
    mysqli_free_result($erg);
    mysqli_close($db_link);


    if ($result == $recID) {
        //Einzahlung an sich selbst -- verboten 
        echo "Error, sie können nicht an sich selbst überweisen"; 

    } else {
        //prüfen ob Konto existiert
        require __DIR__ . "/../conn.php";

        $sql = "SELECT * FROM bankaccount WHERE id = '$recID'"; 
        $erg = mysqli_query($db_link, $sql);
        if (!$erg) {
            die("Ungültige Abfrage: " . mysqli_error($db_link));
        } 
        
        while ($zeile = mysqli_fetch_assoc($erg)) {
            $result =  $zeile["id"];
        }
        mysqli_free_result($erg);
        mysqli_close($db_link);

        if ($result == $recID) {
            //Alles okay - account existiert 

            //banklog ergänzen, um Einzahlungen zu verfolgen 
            require __DIR__ . "/../conn.php";
            $sql = "INSERT INTO banklog(oId, bId, val) VALUES('$_SESSION[loginID]', '$recID', '$amount')";
            $erg = mysqli_query($db_link, $sql);
            if (!$erg) {
                die("Ungültige Abfrage: " . mysqli_error($db_link));
            }


            //Kontostand Empfänger anpassen 

            require __DIR__ . "/../conn.php";
            $sql = "SELECT balance FROM bankaccount WHERE id = '$recID'";
            $erg = mysqli_query($db_link, $sql);
            if (!$erg) {
                die("Ungültige Abfrage: " . mysqli_error($db_link));
            }
            while ($zeile = mysqli_fetch_assoc($erg)) {
                $balance = $zeile["balance"];
            }

            mysqli_free_result($erg);
            mysqli_close($db_link);


            $balance = $balance + $amount; 

            require __DIR__ . "/../conn.php";
            $sql = "UPDATE bankaccount SET balance = '$balance' WHERE id = '$recID'";
            $erg = mysqli_query($db_link, $sql);
            if (!$erg) {
                die("Ungültige Abfrage: " . mysqli_error($db_link));
            }
            
            mysqli_close($db_link);
            
            echo "Überweisung erfolgreich"; 

        } else {
            //Konto existiert nicht 
            echo "Error, das angegebene Konto existiert nicht";

        }
        
    }

    ?>

    <a href="/gov/dashboard.php">Zurück</a>
        
    
    





