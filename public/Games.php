<?php
// This page lists every game from the /games folder in a GameTile.
include('../includes/Page.php');
include('../includes/GameTile.php');

$page = new Page('Games');

$tiles = [];

// TODO: generate the content of the page