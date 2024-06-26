<?php session_start();
// This page lists every game from the /games folder in a GameTile.
/* @var PDO $dbConn
 *
 */
$title = 'Games';
require_once '../includes/config.php';
require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>
        <div id="page-container">
          <div id="content-wrap">';


$dir = '../../games';

// TODO: add sort option for GameTiles

if (is_dir($dir)) {
    $contents= scandir($dir);

    $folders = array_diff($contents, ['.', '..', '.DS_Store']);

    if (count($folders) == 0) {
        exit('<p style="margin-top: 10%; font-size: 20px; text-align: center;">No games found!</p>');
    }
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
