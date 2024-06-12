<?php
// Creates the HTML content for a Game page based on the title of the game
class GameLoader {
    private int $plays = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;
    private int $id;
    private PDO $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
        $this->setGameId();
        $this->setPlays();
    }

    private function setGameId() : void {
        $sql = 'select distinct id from Games where title = :title';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('title', $this->title);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            $this->id = -1;
            error_log("ERROR: id could not be set on Game $this->title.");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            $this->id = -1;
            return;
        }

        $this->id = $row['id'];
    }

    private function setPlays() : void {
        $sql = 'select count(*) as plays from GamePlays where gameId = :id';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('id', $this->id);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            error_log("ERROR too many rows from querying plays for Game '$this->title'");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            error_log("ERROR setting plays for Game: '$this->title'");
            return;
        }

        $this->plays = $row['plays'];
    }

    public function secondsSinceLastPlay($ip) : int {
        if ($this->id == -1) {
            error_log("ERROR in GameLoader.php: Invalid Game id (-1). Unable to check seconds since last game play.");
            return 0;
        }

        $sql = 'select timestamp
                from GamePlays
                where gameId = :id and ip = :ip
                order by timestamp desc
                limit 1';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('ip', $ip);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            return 999999999;
        }

        $row = $stmt->fetch();

        if (!$row) {
            return 999999999;
        }

        try {
            $lastPlay = new DateTime($row['timestamp']);
        } catch (Exception $e) {
            error_log("$e: Error getting lastPlay timestamp in GameLoader.php");
            return 999999999;
        }

        $now = (new DateTime('now'));
        return abs($now->getTimestamp() - $lastPlay->getTimestamp());
    }

    public function addPlay($ip): bool {
        if ($this->id == -1) {
            error_log("ERROR in GameLoader.php: Invalid Game id (-1). Unable to increase game plays.");
            return false;
        }
        $sql = 'insert into GamePlays (timestamp, ip, gameId)
                values(now(), :ip, :gameId)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('ip', $ip);
        $stmt->bindParam('gameId', $this->id);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            error_log("ERROR in GameLoader.php: error increasing play of Game id: $this->id");
            return false;
        }

        return true;
    }

    public function getHTMLString(): string {
        if (!file_exists("../../games/$this->title")) {
            return "<p style='text-align: center; font-size: 20px; margin-top: 100px;'>Game: <b>$this->title</b> not found</p>";
        }

        $devLogTitle = urlencode($this->title);
        $redirectUrl = "DevLog.php?title=Dev+Log+-+$devLogTitle";

        if (file_exists("../../devlogs/Dev Log - " . $this->title)) {
            $devlogButtonHTML = '<a class="button-anchor" href="' . $redirectUrl . '"><div class="devlog-link-button button" >Read The DevLog</div></a>';
        }
        else {
            $devlogButtonHTML = '<div class="devlog-link-button no-link" >No Dev Log Exists</div>';
        }

        $html = '
        <div class="game-container">
            <div class="game-top-bar-wrapper">
                <div class="game-top-bar">
                    <div class="game-title">' . $this->title . '</div>
                    <div class="game-plays">Plays: ' . number_format($this->plays) . '</div>' .
                    $devlogButtonHTML . '
                </div>
            </div>
            <div class="iframe-container">
                <iframe class="game-iframe"  src="../../games/' . $this->title . '/index.html"></iframe>
            </div>
        </div>
        ';
        return $html;
    }
}
