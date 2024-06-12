<?php
/* @var Page $page
 *
 */

const SITE_HIT_MIN_SECONDS = 1200; /* 1200 sec = 20 min */
$ip = $_SERVER['REMOTE_ADDR'];

$secondsSinceLastPageView = $page->secondsSinceLastSiteActivity($ip);
if ($secondsSinceLastPageView < 1) {
    return;
}

if ($secondsSinceLastPageView > SITE_HIT_MIN_SECONDS) {
    $page->addSiteHit($ip);
}
