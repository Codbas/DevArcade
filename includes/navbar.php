<nav>
    <div class="navbar-container">
        <a class="logo" href="../public/Home.php">Logo</a>
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
        <a id="login-button" href="../public/Login.php">
            <input type="button" value="Log In">
        </a>
    </div>
</nav>