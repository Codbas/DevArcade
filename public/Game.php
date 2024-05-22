<?php session_start();
/* @var PDO $dbConn
 *
 */
// Retrieved with GET, the game to load is under the parameter "game"

// TODO: remove all characters except letters, numbers, and hyphens from $title

$title = urldecode($_GET['title']);
require_once '../includes/config.php';

echo '<body>';

$game = new GameLoader($title, $dbConn);

echo $game->getHTMLString();

include('../includes/footer.php');
