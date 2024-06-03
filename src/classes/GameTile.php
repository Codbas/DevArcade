<?php
include_once('Tile.php');
// Get information for game tiles. Return HTML content for them
class GameTile extends Tile {
    private int $plays = 0;

    function __construct(string $title, $dbConn) {
        parent::__construct($title, $dbConn);
        $this->setDescription();
        // TODO: connect to database to get plays for the game (plays are stored individually, so the query needs to count them)
    }

    public function getPlays(): int {
        return $this->plays;
    }

    public function getHTMLString(): string {
        $html = '
    <div class="game-tile-container" id="' . $this->title . '" data-url="Game.php?title=' . urlencode($this->title) . '">
        <div class="title-play-container">
            <div class="game-title">' . $this->title . '</div>
            <div class="play-counter">Plays: ' . $this->plays . '</div>
        </div>
        <div class="game-description"><p>' . $this->description . '</p></div>
        <div class="image-container">
            <img class="game-image" src="../../games/' . $this->title . '/image.jpg">
        </div>
    
    </div>
        ';
        return $html;
    }

    public function getHTMLEventListener(): string {
        $html = '
    <script>
        let gameTiles = document.getElementsByClassName("game-tile-container");
        
        for (let i = 0; i < gameTiles.length; i++) {
            gameTiles[i].addEventListener("click", function() {
                window.location.href = gameTiles[i].getAttribute("data-url");
            });
        }
    </script>
    ';
        return $html;
    }

    private function setDescription(): void {
        $sql = 'select description from Games where title = :title limit 1';
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
