<?php
// called with a GET method, the parameter "title" is used to load the dev log.
$title = urldecode($_GET['title']);
include('../includes/db.php');
include('../includes/DevLog.php');
include('../includes/Page.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page($title, $dbConn); // is this needed?

// TODO: create a database connection

// TODO: look for devlog with the title from $_POST['title']

// TODO : if no devlog found, display error message and stop executing script



$devlog = new DevLog($title, $dbConn);

echo $devlog->getHTMLString();


include('../includes/footer.php');