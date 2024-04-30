<?php
// Creates the HTML content for a Game page based on the title of the game
class GameLoader {
    private int $plays = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;

    function __construct(string $title /*, $dbConn */ ) {
        $this->title = $title;

        // TODO: connect to database to assign $plays and $description
    }

    public function getPlays() : int {
        return $this->plays;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function addPlay() {
        // TODO: logic to ensure the play should be added to the database

        // TODO: check that game with an id exists, if not, create one

        // TODO: get gameid for this game

        // TODO: connect to database and add play (gameid, ip,timestamp)
    }
    public function getHTMLString() : string {
        $html = '';

        // TODO: generate HTML content for the games page

        return $html;
    }
}
?>