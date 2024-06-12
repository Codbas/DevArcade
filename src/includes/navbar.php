<?php
/* @var bool $loggedIn
 * @var string $title
 * */ ?>

<nav>
    <div class="navbar-container">
        <a id="logo-anchor" class="logo" href="../public/Home.php">
            <img id="logo-img" alt="logo" src="../res/logo.svg">
            <div id="logo-text">
                <div id="logo-text-dev"><div class="logo-capital">D</div>ev</div>
                <div id="logo-text-arcade"><div class="logo-capital">A</div>rcade</div>
            </div>
        </a>
        <ul class="navbar">
            <li <?php if ($title == 'Home') echo 'class="active"';?> >
                <a href="../public/Home.php">Home</a>
            </li>
            <li <?php if ($title == 'Games') echo 'class="active"';?> >
                <a href="../public/Games.php">Games</a>
            </li>
            <li <?php if ($title == 'Dev Logs') echo 'class="active"';?> >
                <a href="../public/DevLogs.php">Dev Logs</a>
            </li>
            <li <?php if ($title == 'About') echo 'class="active"';?> >
                <a href="../public/About.php">About</a>
            </li>
        </ul>
        <?php if ($loggedIn) echo '
        <div class="button-anchor" id="dashboard-wrapper">
                <div class="button" id="dashboard-button" >Dashboard</div>
        </div>
        ';
        else echo '
            <a class="button-anchor" id="login-button-anchor" href="../public/Login.php">
                <div class="button" id="login-button">Log In</div>
            </a>
        '; ?>
    </div>
</nav>