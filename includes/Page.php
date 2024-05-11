<?php
// Each page under /public has a Page class. Generates HTML content
// for the header and footer. Logic for adding page views and site hits.
class Page {
    private string $title;
    private $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
    }
    public function getNavbarHTMLString() : string {
        $title = $this->title;
        return strval(include('../includes/navbar.php'));
    }
    public function getHeaderHTMLString() : string {
        return include('../includes/header.php');
    }
    public function getFooterHTMLString() : string {
        return strval(include('../includes/footer.php'));
    }
    public function incPageViews(string $ip) : bool {
        // TODO: use $dbConn add view (ip, datetime, pageName)
        return true;
    }
    public function incSiteHit() : bool {
        // TODO: use $dbConn to add a hit to the site (ip, datetime)
        return true;
    }
    public function secondsSinceLastPageView(string $ip) : int {
        // TODO: check database for the last page view time. calculate seconds since and return

        // TODO: if no view found, return -1
        return -1;
    }
    public function secondsSinceLastSiteHit(string $ip) : int {
        // TODO: check database for most recent page view for this ip and calculate and return seconds since

        // TODO: if no view found, return -1
        return -1;
    }
}