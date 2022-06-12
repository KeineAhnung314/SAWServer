<?php
    $cId = $_POST["cId"];

    $pw1 = $_POST["pw1"];
    $pw2 = $_POST["pw2"];

     

    if ($_POST["admin"]) {
        $admin = 1; 
    } else{
        $admin = 0; 
    }

    if ($_POST["zoll"]) {
        $zoll = 1; 
    } else{
        $zoll = 0; 
    }

    if ($_POST["bank"]) {
        $bank = 1; 
    } else{
        $bank = 0; 
    }

    if ($_POST["warehouse"]) {
        $warehouse = 1; 
    } else{
        $warehouse = 0; 
    }

    

        require __DIR__ . "/../modules/conn.php";
        $sql = "SELECT COUNT(id) FROM citizen WHERE id = '$cId'";
                $erg = mysqli_query($db_link, $sql);
                if (!$erg) {
                    die("Ungültige Abfrage: " . mysqli_error($db_link));
                }
                while ($zeile = mysqli_fetch_assoc($erg)) {
                    $anzahl = $zeile["COUNT(id)"];
                }
        
                mysqli_free_result($erg);
                mysqli_close($db_link);

        if ($anzahl == 1){
            if($pw1 == $pw2){
                $pw = hash("sha256", $pw1);

                require __DIR__ . "/../modules/conn.php";
                $sql = "INSERT INTO officer ('warehouse','admin','bank','toll','pw','cId') VALUES ('$warehouse','$admin','$bank','$zoll','$pw','$cId')";
                $erg = mysqli_query($db_link, $sql);
                if (!$erg) {
                    die("Ungültige Abfrage: " . mysqli_error($db_link));
                }
                mysqli_free_result($erg);
                mysqli_close($db_link);


            }

            
        }else{
            //Fehler
            echo "Error"; 
        }
