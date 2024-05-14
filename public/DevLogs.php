<?php
// This page lists every dev log from the /devlogs folder in a DevLog tile.
$title = 'Dev Logs';
include('../includes/db.php');
include('../includes/Page.php');
include('../includes/DevLogTile.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page('Dev Logs', $dbConn);

$dir = '../devlogs';

// TODO: add sort option for DevLog Tiles

if (is_dir($dir)) {
    $contents= scandir($dir);

    $folders = array_diff($contents, ['.', '..']);

    echo '<div class="logs-wrapper">';
    foreach($folders as $folder) {
        if(is_dir($dir . DIRECTORY_SEPARATOR . $folder)) {
            // TODO: create each game tile
            $devLogTile = new DevLogTile($folder, $dbConn);
            echo $devLogTile->getHTMLString();
        }
    }
    echo '</div>';
    echo $devLogTile->getHTMLEventListener();
}
else {
    echo '<p style="margin-top: 10%; font-size: 20px; text-align: center;">No dev logs found!</p>';
}

include('../includes/footer.php');