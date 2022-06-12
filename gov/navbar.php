
    <!-- NAVBAR AND SIDENAV -->
    <script src="/ressource/js/pageworkers.js"></script>
    <script src="/ressource/js/themehelper.js"></script>
    <div class="navbar my">
        <a href="javascript:void(0)" onclick="toggleNav()">☰</a>
        <a style="float: right" href="/modules/logout.php">Abmelden</a>
    </div>

    <div class="sidenav" id="side">
        <h3><?php echo ($_SESSION["fName"] . " " . $_SESSION["lName"]); ?></h3>
        <a <?php if($loc == 0) echo('class="selected"');?> href="/gov/dashboard.php">Startseite</a>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a href="/warehouse/warehouseview.php" target="popup" onclick="window.open(\'/warehouse/warehouseview.php\',\'popup\',\'left=-30,top=-300\'); return false;">Kundenansicht</a>') ?>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a '); if($loc == 2) echo('class="selected"'); echo('href="/warehouse/watchorders.php">Bestellungen einsehen</a>')?>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a '); if($loc == 12) echo('class="selected"'); echo('href="/warehouse/pickuporder.php">Bestellungen abholen</a>')?>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a '); if($loc == 3) echo('class="selected"'); echo('href="/warehouse/newOrder.php">neuer Auftrag</a>')?>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a '); if($loc == 4) echo('class="selected"'); echo('href="/warehouse/productoverview.php">Produkte verwalten</a>')?>
        <?php if ($_SESSION['perm']['warehouse']) echo ('<a '); if($loc == 5) echo('class="selected"'); echo('href="/warehouse/shoppingoverview.php">Einkaufsliste</a>')?>

        <?php if ($_SESSION['perm']['toll']) echo ('<a '); if($loc == 6) echo('class="selected"'); echo('href="/gov/tollentrence.php">Zoll Anmeldung</a>')?>
        <?php if ($_SESSION['perm']['toll']) echo ('<a '); if($loc == 7) echo('class="selected"'); echo('href="/gov/tollexit.php">Zoll Abmeldung</a>')?>

        <?php if ($_SESSION['perm']['bank']) echo ('<a '); if($loc == 8) echo('class="selected"'); echo('href="/gov/inpayment.php">Einzahlungen</a>')?>

        <?php if ($_SESSION['perm']['admin']) echo ('<a '); if($loc == 9) echo('class="selected"'); echo('href="/admin/transactionlog.php">Überweisungslog</a>')?>
        <?php if ($_SESSION['perm']['admin']) echo ('<a '); if($loc == 10) echo('class="selected"'); echo('href="/admin/presence.php">Anwesenheitskontrolle</a>')?>
        <?php if ($_SESSION['perm']['admin']) echo ('<a '); if($loc == 11) echo('class="selected"'); echo('href="/admin/officerlist.php">Beamtenverwaltung</a>')?>

        <a <?php if($loc == 1) echo('class="selected"');?> href="/gov/password.php">Passwort ändern</a>
        <form id="themechange" action="/modules/formhandler/changetheme.php" method="post">
            <select name="theme" onchange="changeTheme()" id="theme" class="bottom" >
                <option disabled selected hidden >Theme: <?php echo($_SESSION["theme"]);?></option>
                <option value="Dunkel" >Dunkel</option>
                <option value="Hell">Hell</option>
            </select>
        </form>
    </div>
