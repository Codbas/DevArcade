<?php session_start();
// The Home page for the website
/* @var PDO $dbConn
 *
 */
$title = 'Home';
require_once '../includes/config.php';

echo '<body>';

$featuredGame = 'Game Three';
$featuredDevLog = 'Dev Log - Game Three';
$gameTile = new GameTile($featuredGame, $dbConn);
$devLogTile = new DevLogTile($featuredDevLog, $dbConn);

echo '
<div class="home-wrapper">
    <div class="welcome-text-wrapper">
        <p class="welcome-text">Welcome to DevArcade!</p>
    </div>
    <div class="home-content"> 
        <p class="featured-text">Featured</p>
        <div class="featured-container">' .
                $gameTile->getHTMLString() . '
' .
                $devLogTile->getHTMLString() . '
        </div>
    </div>
</div>';

echo $gameTile->getHTMLEventListener();
echo $devLogTile->getHTMLEventListener();

// TODO: Check to see if page should increment site hit and page view

include('../includes/footer.php');
