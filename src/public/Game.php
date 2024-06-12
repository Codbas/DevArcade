<?php session_start();
/* @var PDO $dbConn
 *
 */
// Retrieved with GET, the game to load is under the parameter "game"

if (!isset($_GET['title'])) {
    $title = 'Game';
}
else {
    $title = urldecode($_GET['title']);
    $title = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $title);
}

require_once '../includes/config.php';

echo '<body>';

$gamesDir = '../../games';
$gameExists = true;

if (!is_dir($gamesDir)) {
    $devlogExists = false;
}
if ($gameExists) {
    $contents = scandir($gamesDir);
    $folders = array_diff($contents, ['.', '..', '.DS_Store']);
    if (!in_array($title, $folders)) {
        $gameExists = false;
    }
}

if (!$gameExists) {
    exit('<p style="margin-top: 10%; font-size: 20px; text-align: center;">ERROR: ' . $title . ' does not exist</p>');
}

$ip = $_SERVER['REMOTE_ADDR'];
$game = new GameLoader($title, $dbConn);

echo $game->getHTMLString();

if ($game->secondsSinceLastPlay($ip) > 60) {
    $game->addPlay($ip);
}

include('../includes/footer.php');
