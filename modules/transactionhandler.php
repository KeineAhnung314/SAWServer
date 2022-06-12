<?php
session_start();
error_reporting(0);


require __DIR__ . "/../modules/transactioncheck.php";
require __DIR__ . "/../modules/transactionimp.php";
require __DIR__ . "/../modules/transactiontax.php";
require __DIR__ . "/../modules/transactionsanitation.php";

    $amount = $_POST["amount"];
    $recID = $_POST['recID'];
    $txtL = $_POST["txtL"];
    $txtR = $_POST['txtR'];
    $sendID = $_POST["sendId"];

    
    //Sanitation
    $amount = sanitationfloat($amount); 
    $recID = sanitationint($recID); 
    $txtL = sanitationstring($txtL); 
    $txtR = sanitationstring($txtR); 
    $sendID = sanitationint($sendID);
    

    //Validierung
    $resultrecCheck = recCheck ($recID); 
    $resultsendCheck = sendCheck ($sendID, $amount); 
    $resultvalueCheck = valueCheck ($amount); 
    $resultrecsendChek = recsendChek ($sendID, $recID);
   
    if ($resultrecCheck == "okay") {
        if ($resultrecsendChek == "okay") {
            if ($resultsendCheck == "okay") {
                if ($resultvalueCheck == "okay") { 

                    if (!empty(taxCheck($recID))) {
                        $tax = taxCheck($recID); 
                        $taxVal = taxValue($amount, $tax); 
                    } else {
                        $taxVal = 0; 
                    }

                    $amount = $amount - $taxVal; 

                    //Kontostand Sender verändern 
                    send($sendID, $amount); 

                    //Kontostand Empfänger 
                    receive($recID, $amount); 

                    //Eintrag in transfer
                    transfer($sendID, $recID, $amount, $txtL, $txtR, $taxVal);

                    echo "Überweisung erfolgreich"; 
                    $transfer = "succes"; 
                }
            }
        }
    }

    if (empty($transfer)){
        echo "Es ist ein Fehler bei der Überweisung aufgetreten "; 
    }
   
?> 

<a href="<?php echo $_POST["target"]?>">Zurück</a>


    