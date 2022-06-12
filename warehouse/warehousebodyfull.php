<?php
error_reporting(0);
session_start();
if(!key_exists('loginID',$_SESSION)){
    header("Location: warehousebodyempty.php");
    die();
}
if(!key_exists('perm',$_SESSION)){
    header("Location: warehousebodyempty.php");
    die();
}
if(!isset($_SESSION['loginID'])){
    header("Location: warehousebodyempty.php");
    die();
}
require_once __DIR__ . "/../modules/lib/productlist.php";
require_once __DIR__ . "/../modules/lib/orderstate.php";
if (!$_SESSION['perm']['warehouse']) {
    header("Location: /gov/dashboard.php");
    die();
}
?>
<body>
    <h3>Aufgraggeber:</h3>
    <h3><?php echo (getorderer($_SESSION['order'])) ?></h3>
    <h3>Auftragsnummer:</h3>
    <h3><?php echo($_SESSION['order']); ?></h3>
    <h3>Auftragsstatus:</h3>
    <h3><?php
    if(getorderstate($_SESSION['order']) == 'ordering') echo("OK");
    else echo(getorderstate($_SESSION['order'])); ?></h3>
    <form action="/modules/deleteorderitem.php" method="post">
    <table>
        <tr>
            <th>Anzahl</th>
            <th>Artikelbezeichnung</th>
            <th>Einzelpreis</th>
            <th>Gesamtpreis</th>
        </tr>
        <?php listallorderview($_SESSION["order"],0)?>
    </table>
    </form>
</body>