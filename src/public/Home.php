<?php session_start();
// The Home page for the website
/* @var PDO $dbConn
 *
 */
$title = 'Home';
require_once '../includes/config.php';

$featuredGame = 'Game Three';
$featuredDevlog = 'Dev Log - Game Three';

$gamesDir = '../../games';
$devlogsDir = '../../devlogs';
$gameExists = true;
$devlogExists = true;

if (!is_dir($gamesDir)) {
    $gameExists = false;
}
if (!is_dir($devlogsDir)) {
    $devlogExists = false;
}
if ($gameExists) {
    $contents = scandir($gamesDir);
    $folders = array_diff($contents, ['.', '..', '.DS_Store']);
    if (!in_array($featuredGame, $folders)) {
        $gameExists = false;
    }
}
if ($devlogExists) {
    $contents = scandir($devlogsDir);
    $folders = array_diff($contents, ['.', '..', '.DS_Store']);
    if (!in_array($featuredDevlog, $folders)) {
        $devlogExists = false;
    }
}

echo '<body>';


$gameTile = new GameTile($featuredGame, $dbConn);
$devLogTile = new DevLogTile($featuredDevlog, $dbConn);

echo '
<div class="home-wrapper">
    <div class="welcome-text-wrapper">
        <p class="welcome-text">Welcome to DevArcade!</p>
    </div>
    <div class="home-content"> 
        <p class="featured-text">Featured</p>
        <div class="featured-container">';
if ($gameExists) {
    echo $gameTile->getHTMLString();
}
if ($devlogExists) {
    echo $devLogTile->getHTMLString();
}
if (!$devlogExists && !$gameExists) {
    echo '<p style="margin-top: 10%; font-size: 20px; text-align: center;">No featured content available.</p>';
}
echo '
        </div>
    </div>
</div>';

echo $gameTile->getHTMLEventListener();
echo $devLogTile->getHTMLEventListener();

// TODO: Check to see if page should increment site hit and page view

include('../includes/footer.php');
