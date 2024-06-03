<?php
// Creates the HTML content for a Game page based on the title of the game
class GameLoader {
    private int $plays = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;
    private PDO $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
    }

    public function getPlays(): int {
        return $this->plays;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function addPlay(): bool {
        // TODO: logic to ensure the play should be added to the database

        // TODO: check that game with an id exists, if not, create one

        // TODO: get gameid for this game

        // TODO: connect to database and add play (gameid, ip,timestamp)

        return true;
    }

    public function getHTMLString(): string {
        if (!file_exists("../../games/$this->title")) {
            return "<p style='text-align: center; font-size: 20px; margin-top: 100px;'>Game: <b>$this->title</b> not found</p>";
        }

        $devLogTitle = urlencode($this->title);
        $redirectUrl = "DevLog.php?title=Dev+Log+-+$devLogTitle";

        if (file_exists("../../devlogs/Dev Log - " . $this->title)) {
            $devlogButtonHTML = '<a href="' . $redirectUrl . '"><div class="devlog-link-button" >Play The Game</div></a>';
        }
        else {
            $devlogButtonHTML = '<div class="devlog-link-button no-link" >No Dev Log Exists</div>';
        }

        $html = '
        <div class="game-container">
            <div class="game-top-bar">
                <div class="game-title">' . $this->title . '</div>
                <div class="gane-plays">Plays: ' . $this->plays . '</div>' .
                $devlogButtonHTML . '
            </div>
            <div class="iframe-container">
                <iframe class="game-iframe"  src="../../games/' . $this->title . '/index.html"></iframe>
            </div>
        </div>
        ';
        return $html;
    }
}
