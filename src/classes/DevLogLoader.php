<?php
// Creates the HTML content for a DevLogLoader page based on the title of the dev log
class DevLogLoader {
    private int $views = 0;
    private string $description = 'Looks like no description exists...';
    private string $title;
    private int $id;
    private PDO $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
        $this->setDevlogId();
        $this->setViews();
    }

    private function setDevlogId() : void {
        $sql = 'select distinct id from DevLogs where title = :title';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('title', $this->title);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            $this->id = -1;
            error_log("ERROR: id could not be set on DevLog $this->title");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            $this->id = -1;
            return;
        }

        $this->id = $row['id'];
    }

    public function secondsSinceLastView($ip) : int {
        if ($this->id == -1) {
            error_log("ERROR in DevLogLoader.php: Invalid DevLog id (-1). Unable to check seconds since last devlog view.");
            return 0;
        }

        $sql = 'select timestamp
                from DevLogViews
                where devLogId = :id and ip = :ip
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
            $lastView = new DateTime($row['timestamp']);
        } catch (Exception $e) {
            error_log("$e: Error getting lastView timestamp in DevLogLoader.php");
            return 999999999;
        }

        $now = (new DateTime('now'));
        return abs($now->getTimestamp() - $lastView->getTimestamp());;
    }

    private function setViews() : void {
        $sql = 'select count(*) as views from DevLogViews where devLogId = :id';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('id', $this->id);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            error_log("ERROR too many rows from querying views for DevLog '$this->title'");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            error_log("ERROR setting views for DevLog '$this->title'");
            return;
        }

        $this->views = $row['views'];
    }
    public function addView($ip): bool {
        if ($this->id == -1) {
            error_log("ERROR in DevLogLoader.php: Invalid DevLog id (-1). Unable to increase devlog views.");
            return false;
        }
        $sql = 'insert into DevLogViews (timestamp, ip, devLogId)
                values(now(), :ip, :devLogId)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('ip', $ip);
        $stmt->bindParam('devLogId', $this->id);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            error_log("ERROR in DevLogLoader.php: error increasing DevLog view of DevLog id: $this->id");
            return false;
        }

        return true;
    }

    public function getHTMLString(): string {
        if (!file_exists("../../devlogs/$this->title")) {
            return "<p style='text-align: center; font-size: 20px; margin-top: 100px;'>Dev Log: <b>$this->title</b> not found</p>";
        }

        $gameTitle = urlencode(substr($this->title, 10));
        $redirectUrl = "Game.php?title=$gameTitle";

        if (file_exists("../../games/" . substr($this->title, 10))) {
            $gameButtonHTML = '<a class="button-anchor" href="' . $redirectUrl . '"><div class="game-link-button button" >Play The Game</div></a>';
        }
        else {
            $gameButtonHTML = '<div class="game-link-button no-link" >No Game Exists</div>';
        }

        $html = '
        <div class="devlog-container">
            <div class="devlog-top-bar">
                <div class="devlog-title">' . $this->title . '</div>
                <div class="devlog-views">Views: ' . number_format($this->views) . '</div>' .
                $gameButtonHTML . '
            </div>
                <iframe class="devlog-iframe" onload="this.height=(this.contentWindow.document.body.scrollHeight) + 100;" src="../../devlogs/' . $this->title . '/index.html"></iframe>
        </div>
        ';
        return $html;
    }
}
