<?php
// Included in every Page. Checks to see if session on the server is expired.
// Logs user out if session is expired. Updates session activity otherwise.
/* @var PDO $dbConn
 * @var string $title
 * @var string[] $pages
 */

const SESSION_TIMEOUT_SECONDS = 3600;
$pages = ['Home', 'Games', 'Dev Logs', 'About', 'Change Password', 'Log In', 'Manage Content'];

if (in_array($title, $pages)) {
    $page = new Page($title, $dbConn);
}
else {
    $page = new Page($scriptName = basename($_SERVER['SCRIPT_NAME'], '.php'), $dbConn);
}

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    $loggedIn = false;
    return;
}

$username = $_SESSION['username'];
$sessionId = $_SESSION['sessionId'];

if ($username === NULL || $sessionId === NULL) {
    error_log("ERROR: session data is null in session.php");
    $loggedIn = false;
    return;
}

$secondsSinceLastSessionActivity = $page->secondsSinceLastActiveSession($sessionId, $username);
if ($secondsSinceLastSessionActivity < 1) {
    $loggedIn = true;
    return;
}

if ($secondsSinceLastSessionActivity > SESSION_TIMEOUT_SECONDS) {
    if (!$page->logout($sessionId)) {
        error_log("ERROR: page->logout() in session.php");
    }
    $loggedIn = false;
    return;
}

$loggedIn = true;
if (!$page->updateLastActiveSession($sessionId)) {
    error_log("ERROR: could not update session activity. session.php: page->updateLastActiveSession. title: $title, username: $username, sessionId: $sessionId");
}
