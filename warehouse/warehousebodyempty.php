<body>
    <h1>Guten Tag!</h1>
    <?php
    require __DIR__ . "/../modules/lib/getserver.php";
    $login = 1;
    if (!isset($_SESSION)) session_start();
    if (!key_exists("perm", $_SESSION)) $login = 0;

    else if (!$_SESSION['perm']['warehouse']) {
        $login = 0;
    }
    if($login == 1) $s = getservername($_SESSION['loginID']);
    ?>
    <h3> <?php if($login == 1) echo ("Sie werden bedient von: $s[fName] $s[lName]"); else echo("&nbsp;");?></h3>
    <img src="/ressource/Laupp.jpg" alt="" srcset="">
</body>