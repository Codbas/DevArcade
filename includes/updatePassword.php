<?php session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    exit();
}
if (!isset($_POST['username'], $_POST['password'], $_POST['newPassword'], $_POST['confirmPassword'])) {
    echo "<p style='color: red;'>Request must contain a username, password, new password, and confirm password.</p>";
    exit();
}

include('../includes/db.php');
include('../includes/authUser.php');

$username = $_POST['username'];
$password = $_POST['password'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];
$ip = $_SERVER['REMOTE_ADDR'];

if (strlen($username) < 4 || strlen($username) > 20 ||
    strlen($password) < 8 || strlen($password) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $password)) {
    echo "<p style='color: red;'>Invalid username or password</p>";
    exit();
}

if ($newPassword != $confirmPassword) {
    echo "<p style='color: red;'>Passwords do not match.</p>";
    exit();
}

if (strlen($newPassword) < 8 || strlen($newPassword) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $newPassword) ||
    strlen($confirmPassword) < 8 || strlen($confirmPassword) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $confirmPassword)) {
    echo "<p style='color: red;'>Invalid new password.</p>";
    exit();
}

// TODO: authenticate user

// TODO: validate that password meets requirements

// TODO: update password in database

// TODO: return success or fail message

?>
