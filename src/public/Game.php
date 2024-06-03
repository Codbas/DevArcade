<?php session_start();
/* @var PDO $dbConn
 *
 */
// Retrieved with GET, the game to load is under the parameter "game"

$title = urldecode($_GET['title']);
$title = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $title);
require_once '../includes/config.php';

echo '<body>';

$game = new GameLoader($title, $dbConn);

echo $game->getHTMLString();

include('../includes/footer.php');
