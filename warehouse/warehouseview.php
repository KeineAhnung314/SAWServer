<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1; URL=warehouseview.php">
    <link rel="stylesheet" href="/style.css">
    <title>Kundenansicht</title>
</head>
<?php
session_start();
?>
<body>
<?php
if(key_exists('order',$_SESSION) AND $_SESSION['order']>1) require "warehousebodyfull.php";
else if(key_exists('rorder',$_SESSION)AND $_SESSION['rorder']>1) require "warehousebodyedit.php";
else require "warehousebodyempty.php";
?>  
</body>

</html>