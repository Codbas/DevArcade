<?php
// Retrieved with GET, the game to load is under the parameter "game"
$title = urldecode($_GET['title']);
include('../includes/db.php');
include('../includes/GameLoader.php');
include('../includes/Page.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page($title, $dbConn); // is this needed?

// TODO: create a database connection

// TODO: look for game with the title from $_POST['game']

// TODO : if no game found, display error message and stop executing script

// $title = $_POST['game'];

// $game = new GameLoader($title);

// echo $game->getHTMLString();

include('../includes/footer.php');
