<?php session_start();
// Page for changing password
$title = 'Change Password';

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    exit('ERROR 401: Unauthorized');
}

require_once '../includes/config.php';
require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>
        <div id="page-container">
          <div id="content-wrap">
            <form id="change-password-form" hx-post="includes/updatePassword.php" hx-target="#password-message" hx-swap="innerHTML">
                <div class="current-password-container">
                    <label for="current-password" id="current-password-label">Current Password</label>
                    <input class="textbox" type="password" id="current-password" name="currentPassword" minlength="8" maxlength="24" 
                    title="Password is required" required>
                </div>
                <div class="new-password-container">
                    <label for="new-password" id="new-password-label">New Password</label>
                    <input class="textbox" type="password" id="new-password" name="newPassword" pattern="[A-Za-z0-9!@#$%^&*()?.-]" minlength="8" 
                    maxlength="24" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
                </div>
                <div class="confirm-password-container">
                    <label for="confirm-password" id="confirm-password-label">Confirm Password</label>
                    <input class="textbox" type="password" id="confirm-password" name="confirmPassword" pattern="[A-Za-z0-9!@#$%^&*()?.-]" minlength="8" 
                    maxlength="24" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
                </div>
                <input type="hidden" id="username" name="username" value="' . $_SESSION['username'] . '">
                <input type="hidden" id="sessionId" name="sessionId" value="' . $_SESSION['sessionId'] . '">
                <input class="button" type="submit" id="change-password-button" value="Change Password">
                <div id="password-message"></div>
            </form>
';

include('../includes/footer.php');
