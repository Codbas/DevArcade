<?php
/* @var PDO $dbConn
 *
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "ERROR 401: Unauthorized";
    exit();
}
if (!isset($_POST['sessionId'], $_POST['username'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
    echo "ERROR 401: Unauthorized";
    exit();
}

include('../../includes/db.php');

$sessionId = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['sessionId']);
$username = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['username']);

if (strlen($sessionId) > 255 || strlen($username) > 20) {
    echo "ERROR 401: Unauthorized";
    exit();
}

$sql = 'select count(*)
        from Sessions
        where username = :username and sessionId = :sessionId';
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':sessionId', $sessionsId);
$stmt->execute();

if ($stmt->rowCount() != 1) {
    echo "ERROR 401: Unauthorized";
    exit();
}

// sessionId and username are valid

$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];
$ip = $_SERVER['REMOTE_ADDR'];

if (strlen($currentPassword) < 8 || strlen($currentPassword) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $currentPassword)) {
    echo "<p style='color: red;'>Current password is incorrect.</p>";
    exit();
}

$sql = 'select password
        from Users
        where username = :username';
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->rowCount() != 1) {
    echo "<p style='color: red;'>ERROR: 1201</p>";
    exit();
}

$passwordHash = $stmt->fetch()['password'];

if (!password_verify($currentPassword, $passwordHash)) {
    echo "<p style='color: red;'>Current password is incorrect.</p>";
    exit();
}


if ($newPassword != $confirmPassword) {
    echo "<p style='color: red;'>New password and confirm password do not match.</p>";
    exit();
}

if ($newPassword == $currentPassword) {
    echo "<p style='color: red;'>New password must be different from current password.</p>";
    exit();
}

if (strlen($newPassword) < 8 || strlen($newPassword) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $newPassword) ||
    strlen($confirmPassword) < 8 || strlen($confirmPassword) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $confirmPassword)) {
    echo "<p style='color: red;'>New password contains invalid characters. Only letters, numbers and !@#$%^&*()?.- symbols allowed.</p>";
    exit();
}

// password matching pattern: 12-24 characters, at least one uppercase, lowercase, number, and symbol !@#$%^&*()?.-
$pattern = '/^(?=.*[!@#$%^&*()?.-])(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{12,24}$/';

if (!preg_match($pattern, $newPassword)) {
    echo "<p>New password must be 12-24 characters and contain at least one uppercase letter, lowercase letter, number, and the following symbol !@#$%^&*()?.- </p>";
    exit();
}

// User has been authenticated and password has been verified.

$cost = 12;
$passwordHash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => $cost]);

$sql = 'update Users
    set password = :passwordHash
    where username = :username';

$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':passwordHash', $passwordHash);
$stmt->bindParam(':username', $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo '<p style="color: green;">Password changed. You will be redirected in 2 seconds...</p>';
    echo '<script>
    setTimeout(function() {
        window.location.href="Home.php";
    }, 2000);
    </script>';
}
else {
    echo '<p style="color: red;">ERROR: Failed to change password.</p>';
}
