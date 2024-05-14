<?php
// website admin login page. NO plans for user login capabilities.
$title = 'Log In';

include('../includes/db.php');
include('../includes/Page.php');
include('../includes/PasswordManager.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page($title, $dbConn);

// TODO: check if user is already logged in

echo '
    <form id="login-form" action="../includes/validateLogin.php" method="POST">
        <div class="username-container">
            <label for="username" id="username-label">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="password-container">
            <label for="password" id="password-label">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" id="submit-button" value="Log In">
        <div id="login-message"></div>
    </form>
';

// TODO: log page view information

include('../includes/footer.php');
