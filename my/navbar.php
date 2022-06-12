
    <!-- NAVBAR AND SIDENAV -->
    <script src="/ressource/js/pageworkers.js"></script>
    <script src="/ressource/js/themehelper.js"></script>
    <div class="navbar my">
        <a href="javascript:void(0)" onclick="toggleNav()">☰</a>
        <a style="float: right" href="/modules/logout.php">Abmelden</a>
    </div>

    <div class="sidenav" id="side">
        <h3><?php echo ($_SESSION["fName"] . " " . $_SESSION["lName"]); ?></h3>
        <a <?php if($loc == 0) echo('class="selected"');?> href="/my/dashboard.php">Startseite</a>
        <a <?php if($loc == 1) echo('class="selected"');?> href="transaction.php">Überweisungen</a>
        <a <?php if($loc == 2) echo('class="selected"');?> href="password.php">Passwort ändern</a>
        <form id="themechange" action="/modules/formhandler/changetheme.php" method="post">
            <select name="theme" onchange="changeTheme()" id="theme" class="bottom" >
                <option disabled selected hidden >Theme: <?php echo($_SESSION["theme"]);?></option>
                <option value="Dunkel" >Dunkel</option>
                <option value="Hell">Hell</option>
            </select>
        </form>
    </div>
