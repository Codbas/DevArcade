<?php
// Creates the HTML content for a DevLog page based on the title of the dev log
class DevLog {
    private int $views = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;
    private $dbConn;

    function __construct(string $title /*, $dbConn */ ) {
        $this->title = $title;

        // TODO: $this->dbConn = $dbConn;

        // TODO: connect to database to assign $views and $description
    }

    public function getViews() : int {
        return $this->views;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function addView() {
        // TODO: logic to ensure the view should be added to the database

        // TODO: check that dev log with an id exists, if not, create one

        // TODO: get devlogid for this dev log

        // TODO: connect to database and add view (devlogid, ip,timestamp)
    }
    public function getHTMLString() : string {
        $html = '';

        // TODO: generate HTML content for the devlog page

        return $html;
    }
}
?>