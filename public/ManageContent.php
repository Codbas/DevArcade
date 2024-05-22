<?php session_start();
$title = 'Manage Content';

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    echo '<p>ERROR 501: Unauthorized</p>';
    exit();
}

require_once '../includes/config.php';

echo '<body>';

// TODO: increase manage content page view by 1

// TODO: load manage content page

include('../includes/footer.php');
