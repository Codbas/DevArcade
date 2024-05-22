<nav>
    <div class="navbar-container">
        <a class="logo" href="../public/Home.php">
            <img alt="rand" src="../res/logo.svg"></a>
        <ul class="navbar">
            <li <?php if ($title == 'Home') echo 'class="active"';?> >
                <a href="../public/Home.php">Home</a>
            </li>
            <li <?php if ($title == 'Games') echo 'class="active"';?> >
                <a href="../public/Games.php">Games</a>
            </li>
            <li <?php if ($title == 'DevLogs') echo 'class="active"';?> >
                <a href="../public/DevLogs.php">Dev Logs</a>
            </li>
            <li <?php if ($title == 'About') echo 'class="active"';?> >
                <a href="../public/About.php">About</a>
            </li>
        </ul>
        <?php if ($loggedIn) echo '
        <div id="dashboard-wrapper">
                <input type="button" id="dashboard-button" value="Dashboard">
        </div>
        ';
        else echo '
        <div id="login-button-wrapper">
            <a id="login-button-anchor" href="../public/Login.php">
                <input type="button" id="login-button" value="Log In">
            </a>
        </div>
        '; ?>
    </div>
</nav>