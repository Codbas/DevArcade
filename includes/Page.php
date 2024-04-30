<?php
// Each page under /public has a Page class. Generates HTML content
// for the header and footer. Logic for adding page views and site hits.
class Page {
    private string $pageName;
    private $dbConn;

    function __construct(string $pageName /*, $dbConn */) {
        $this->pageName = $pageName;

        // TODO: $this->dbConn = $dbConn;
    }
    public function getHeaderHTMLString() : string {
        $html = '';
        // TODO : generate HTML header content based on current page

        return $html;
    }
    public function getFooterHTMLString() : string {
        $html = '';
        // TODO: generate HTML footer content
        return $html;
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