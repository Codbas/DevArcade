<?php session_start();
// called with a GET method, the parameter "title" is used to load the dev log.
/* @var PDO $dbConn
*/

$title = urldecode($_GET['title']);
$title = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $title);
require_once '../includes/config.php';

echo '<body>';

// TODO : if no devlog found, display error message and stop executing script

// TODO: increment dev log view count

$devlog = new DevLogLoader($title, $dbConn);

echo $devlog->getHTMLString();

include('../includes/footer.php');
