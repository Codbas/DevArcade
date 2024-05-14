<?php
// The Home page for the website
$title = 'Home';

include('../includes/db.php');
include('../includes/Page.php');
include('../includes/GameTile.php');
include('../includes/DevLogTile.php');

include('../includes/header.php');
include('../includes/navbar.php');
echo '<body>';

$page = new Page($title, $dbConn);

$featuredGame = 'Game One';
$featuredDevLog = 'Dev Log - Game One';
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

// TODO: generate the content of the page


include('../includes/footer.php');