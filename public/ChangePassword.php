<?php session_start();
// Page for changing password
$title = 'Change Password';

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    echo '<p>ERROR 501: Unauthorized</p>';
    exit();
}

require_once '../includes/config.php';

echo '<body>';

// TODO: increment view count for this page

// TODO: load change password page content

echo '
    <form id="change-password-form" hx-post="../includes/updatePassword.php" hx-target="#password-message" hx-swap="innerHTML">
        <div class="current-password-container">
            <label for="current-password" id="current-password-label">Current password</label>
            <input type="text" id="current-password" name="currentPassword" pattern="" minlength="8" maxlength="24" 
            title="Username must be 4-20 characters long and can only contain letters and numbers." required>
        </div>
        <div class="new-password-container">
            <label for="new-password" id="new-password-label">New Password</label>
            <input type="password" id="new-password" name="newPassword" pattern="[A-Za-z0-9!@#$%^&*()?.-]{8,24}" minlength="8" 
            maxlength="24" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
        </div>
        <div class="confirm-password-container">
            <label for="confirm-password" id="confirm-password-label">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirmPassword" pattern="[A-Za-z0-9!@#$%^&*()?.-]{8,24}" minlength="8" 
            maxlength="24" title="Password length: 8-24, valid symbols: !@#$%^&*()?.-" required>
        </div>
        <input type="submit" id="change-password-button" value="Change Password">
        <div id="password-message"></div>
    </form>
';

// TODO: check that new password matches confirm password

// TODO: check that password matches current password

// TODO: update password in Users and display success message

include('../includes/footer.php');
