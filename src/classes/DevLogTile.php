<?php
include_once('Tile.php');
// Get information for dev log tiles. Return HTML content for them
class DevLogTile extends Tile {
    private int $views = 0;

    function __construct(string $title, $dbConn) {
        parent::__construct($title, $dbConn);

        $this->setDescription();

        // TODO: connect to database to get views for the dev log (views are stored individually, so the query needs to count them)
    }

    public function getViews(): int {
        return $this->views;
    }

    public function getHTMLString(): string {
        $html = '
        <div class="log-tile-container" id="' . $this->title . '" data-url="DevLog.php?title=' . urlencode($this->title) . '">
            <div class="title-view-container">
                <div class="log-title">' . $this->title . '</div>
                <div class="view-counter">Views: ' . $this->views . '</div>
            </div>
            <div class="log-description"><p>' . $this->description . '</p></div>
        </div>

        ';
        return $html;
    }

    public function getHTMLEventListener(): string {
        $html = '
    <script>
        let logTiles = document.getElementsByClassName("log-tile-container");
        
        for (let i = 0; i < logTiles.length; i++) {
            logTiles[i].addEventListener("click", function() {
                window.location.href = logTiles[i].getAttribute("data-url");
            });
        }
    </script>
    ';
        return $html;
    }

    private function setDescription(): void {
        $sql = 'select description from DevLogs where title = :title limit 1';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':title', $this->title);
        $stmt->execute();
        if ($stmt->rowCount() === 1) {
            $this->description = $stmt->fetch(PDO::FETCH_ASSOC)['description'];
        } else {
            $this->description = 'There was an error loading the description.';
        }
    }
}

?>
