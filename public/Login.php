<?php
// website admin login page. NO plans for user login capabilities.
$title = 'Log In';
include('../includes/db.php');

include('../includes/Page.php');
include('../includes/PasswordManager.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

// TODO: load login page


$page = new Page($title, $dbConn);

echo "$title page";

include('../includes/footer.php');