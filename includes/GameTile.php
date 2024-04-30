<?php
include_once('Tile.php');
// Get information for game tiles. Return HTML content for them
class GameTile extends Tile{
    private int $plays = 0;

    function __construct(string $title /*, $dbConn */) {
        parent::__construct($title /*, $dbConn */);

        // TODO: connect to database to get plays for the game (plays are stored individually, so the query needs to count them)

    }

    public function getPlays() : int {
        return $this->plays;
    }
    public function getHTMLString() : string {
        $html = '';

        // TODO: create the HTML content for the GameTile

        return $html;
    }
}
?>
