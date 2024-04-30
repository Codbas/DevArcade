<?php
// Retrieved with POST, the game to load is under the parameter "game"
include('../includes/GameLoader.php');

// TODO: create a database connection

// TODO: look for game with the title from $_POST['game']

// TODO : if no game found, display error message and stop executing script

$title = $_POST['game'];

$game = new GameLoader($title);

echo $game->getHTMLString();

