<?php
/* @var Page $page
 *
 */

const PAGE_VIEW_MIN_SECONDS = 60;
$ip = $_SERVER['REMOTE_ADDR'];

$secondsSinceLastPageView = $page->secondsSinceLastPageView($ip);
if ($secondsSinceLastPageView < 1) {
    return;
}

if ($secondsSinceLastPageView > PAGE_VIEW_MIN_SECONDS) {
    $page->addPageView($ip);
}
