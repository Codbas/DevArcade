<?php session_start();
// The About page for the website
$title = 'About';

require_once '../includes/config.php';
require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>
        <div id="page-container">
          <div id="content-wrap">
            <div class="about-wrapper">
                <div class="about-text">
                    <p>DevArcade is all about showcasing what kind of games can be made using HTML, CSS, and JavaScript without
                    any third party libraries or game engines. Simple, but fun, games can be made without any of those fancy tools!
                    Dev Logs for games teach the thought process behind making each game.</p>
                    <p>I hope you enjoy the games and learn something!</p>
                </div>
            </div>
';

include('../includes/footer.php');
