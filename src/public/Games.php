<?php session_start();
// This page lists every game from the /games folder in a GameTile.
$title = 'Games';
require_once '../includes/config.php';

echo '<body>';

$dir = '../../games';

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
