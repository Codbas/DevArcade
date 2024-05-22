<?php
// Creates the HTML content for a DevLogLoader page based on the title of the dev log
class DevLogLoader {
    private int $views = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;
    private $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
    }

    public function getViews() : int {
        return $this->views;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function addView() : bool {
        // TODO: logic to ensure the view should be added to the database

        // TODO: check that dev log with an id exists, if not, create one

        // TODO: get devlogid for this dev log

        // TODO: connect to database and add view (devlogid, ip,timestamp)

        return true;
    }
    public function getHTMLString() : string {
        if (!file_exists("../devlogs/$this->title")) {
            return "<p style='text-align: center; font-size: 20px; margin-top: 100px;'>Dev Log: <b>$this->title</b> not found</p>";
        }

        $gameTitle = urlencode(substr($this->title, 10));
        $redirectUrl = "Game.php?title=$gameTitle";

        $html = '
        <div class="devlog-container">
            <div class="devlog-top-bar">
                <div class="devlog-title">' . $this->title . '</div>
                <div class="devlog-views">Views: ' . $this->views . '</div>
                <a href="' . $redirectUrl . '"><div class="game-link-button" >Play The Game</div></a>
            </div>
                <iframe class="devlog-iframe" onload="this.height=(this.contentWindow.document.body.scrollHeight) + 100;" src="../devlogs/' . $this->title . '/index.html"></iframe>
        </div>
        ';
        return $html;
    }
}
?>
