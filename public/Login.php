<?php session_start();
// website admin login page. NO plans for user login capabilities.
/* @var bool $loggedIn
 *
 */
$title = 'Log In';
require_once '../includes/config.php';

echo '<body>';

if ($loggedIn) {
    echo "<p>You're already logged in!</p>";
    exit();
}

echo '
    <form id="login-form" hx-post="../includes/loginUser.php" hx-target="#login-message" hx-swap="innerHTML">
        <div class="username-container">
            <label for="username" id="username-label">Username</label>
            <input type="text" id="username" name="username" pattern="[A-Za-z0-9]{4,20}" minlength="4" maxlength="20" 
            title="Username must be 4-20 characters long and can only contain letters and numbers." required>
        </div>
        <div class="password-container">
            <label for="password" id="password-label">Password</label>
            <input type="password" id="password" name="password" pattern="[A-Za-z0-9!@#$%^&*()?.-]{8,24}" minlength="8" 
            maxlength="24" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
        </div>
        <input type="submit" id="submit-button" value="Log In">
        <div id="login-message"></div>
    </form>
';


// TODO: log page view information

include('../includes/footer.php');
