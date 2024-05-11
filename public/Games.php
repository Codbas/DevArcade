<?php
// This page lists every game from the /games folder in a GameTile.
$title = 'Games';
include('../includes/db.php');
include('../includes/Page.php');
include('../includes/GameTile.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page('Games', $dbConn);

$dir = '../games';

// TODO: add sort option for GameTiles

if (is_dir($dir)) {
    $contents= scandir($dir);

    $folders = array_diff($contents, ['.', '..']);

    echo '<div class="games-wrapper">';
    foreach($folders as $folder) {
        if(is_dir($dir . DIRECTORY_SEPARATOR . $folder)) {
            $gameTile = new GameTile($folder, $dbConn);
            echo $gameTile->getHTMLString();
        }
    }
    echo '</div>';
    echo $gameTile->getHTMLEventListener();
}
else {
    echo '<p style="margin-top: 10%; font-size: 20px; text-align: center;">No games found!</p>';
}


include('../includes/footer.php');
