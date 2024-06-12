<?php session_start();
// called with a GET method, the parameter "title" is used to load the dev log.
/* @var PDO $dbConn
*/

if (!isset($_GET['title'])) {
    $title = 'Dev Log';
}
else {
    $title = urldecode($_GET['title']);
    $title = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $title);
}
require_once '../includes/config.php';
require_once '../includes/siteHits.php';

echo '<body>';

$devlogsDir = '../../devlogs';
$devlogExists = true;

if (!is_dir($devlogsDir)) {
    $devlogExists = false;
}
if ($devlogExists) {
    $contents = scandir($devlogsDir);
    $folders = array_diff($contents, ['.', '..', '.DS_Store']);
    if (!in_array($title, $folders)) {
        $devlogExists = false;
    }
}

if (!$devlogExists) {
    exit('<p style="margin-top: 10%; font-size: 20px; text-align: center;">ERROR: ' . $title . ' does not exist</p>');
}

$ip = $_SERVER['REMOTE_ADDR'];
$devlog = new DevLogLoader($title, $dbConn);

echo $devlog->getHTMLString();

if ($devlog->secondsSinceLastView($ip) > 60) {
    $devlog->addView($ip);
}

include('../includes/footer.php');
