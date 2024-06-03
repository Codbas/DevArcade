<?php
// Included in every Page. Checks to see if session on the server is expired.
// Logs user out if session is expired. Updates session activity otherwise.
/* @var PDO $dbConn
 * @var string $title
 */

const SESSION_TIMEOUT_SECONDS = 3600;
$page = new Page($title, $dbConn);

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    $loggedIn = false;
    return;
}

$username = $_SESSION['username'];
$sessionId = $_SESSION['sessionId'];

if ($username === NULL || $sessionId === NULL) {
    echo "error: session data is null";
    $loggedIn = false;
    return;
}

$lastSession = $page->secondsSinceLastActiveSession($sessionId, $username);

if ($lastSession > SESSION_TIMEOUT_SECONDS) {
    $page->logout($sessionId);
    $loggedIn = false;
    return;
}

$loggedIn = true;
$page->updateLastActiveSession($sessionId);
