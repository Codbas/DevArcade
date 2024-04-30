<?php
include_once('Tile.php');
// Get information for dev log tiles. Return HTML content for them
class DevLogTile extends Tile{
    private int $views = 0;

    function __construct(string $title /*, $dbConn */) {
        parent::__construct($title /*, $dbConn */);

        // TODO: connect to database to get views for the dev log (views are stored individually, so the query needs to count them)


    }

    public function getViews() : int {
        return $this->views;
    }
    public function getHTMLString() : string {
        $html = '';

        // TODO: create the HTML content for the DevLogTile

        return $html;
    }
}
?>
