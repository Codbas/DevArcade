<?php session_start();
// This page lists every dev log from the /devlogs folder in a DevLogLoader tile.
/* @var PDO $dbConn
 *
 */
$title = 'Dev Logs';
require_once '../includes/config.php';
require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>
        <div id="page-container">
          <div id="content-wrap">';


$dir = '../../devlogs';

// TODO: add sort option for DevLogLoader Tiles

if (is_dir($dir)) {
    $contents= scandir($dir);
    $folders = array_diff($contents, ['.', '..', '.DS_Store']);

    if (count($folders) == 0) {
        exit('<p style="margin-top: 10%; font-size: 20px; text-align: center;">No dev logs found!</p>');
    }

    echo '<div class="logs-wrapper">';
    foreach($folders as $folder) {
        if(is_dir($dir . DIRECTORY_SEPARATOR . $folder)) {
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
