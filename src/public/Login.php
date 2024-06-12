<?php session_start();
// website admin login page. NO plans for user login capabilities.
/* @var bool $loggedIn
 *
 */
$title = 'Log In';
require_once '../includes/config.php';
require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>';

if ($loggedIn) {
    echo "<p>You are already logged in!</p>";
    exit();
}

echo '
    <form id="login-form" hx-post="includes/loginUser.php" hx-target="#login-message" hx-swap="innerHTML">
        <div id="input-container">
            <div class="username-container">
                <label for="username" id="username-label">Username</label>
                <input class="textbox" type="text" id="username" name="username" 
                title="Username must be 4-20 characters long and can only contain letters and numbers." required>
            </div>
            <div class="password-container">
                <label for="password" id="password-label">Password</label>
                <input class="textbox" type="password" id="password" name="password" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
            </div>
            <input class="button" type="submit" id="submit-button" value="Log In">
        </div>
        <div id="login-message"></div>
    </form>
';

include('../includes/footer.php');
