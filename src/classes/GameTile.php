<?php
include_once('Tile.php');
// Get information for game tiles. Return HTML content for them
class GameTile extends Tile {
    private int $plays = 0;
    private int $id;

    function __construct(string $title, $dbConn) {
        parent::__construct($title, $dbConn);
        $this->setGameId();
        $this->setDescription();
        $this->setPlays();
    }

    private function setGameId() : void {
        $sql = 'select distinct id from Games where title = :title';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam('title', $this->title);
        $stmt->execute();

        if ($stmt->rowCount() != 1) {
            $this->id = -1;
            error_log("ERROR: id could not be set on Game $this->title");
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
            error_log("ERROR too many rows from querying plays for Game: '$this->title'");
            return;
        }

        $row = $stmt->fetch();
        if (!$row) {
            error_log("ERROR setting plays for Game '$this->title'");
            return;
        }

        $this->plays = $row['plays'];
    }

    public function getHTMLString(): string {
        $html = '
    <div class="game-tile-container" id="' . $this->title . '" data-url="Game.php?title=' . urlencode($this->title) . '">
        <div class="title-play-container">
            <div class="game-title">' . $this->title . '</div>
            <div class="play-counter">Plays: ' . number_format($this->plays) . '</div>
        </div>
        <div class="game-description"><p>' . $this->description . '</p></div>
        <div class="image-container">
            <img  alt="Game image" class="game-image" src="../../games/' . $this->title . '/image.jpg">
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
      
        let images = document.getElementsByClassName("image-container");
        let parents = document.getElementsByClassName("game-tile-container");
        for (let i = 0; i < images.length; i++) {
            window.addEventListener("resize", function() {
                const parentSize = parents[i].offsetWidth;
                const size = (parentSize - images[i].offsetWidth) / 2;
                images[i].style.left = `${size}px`;
            });
        }
        
        function centerImages() {
            for (let i = 0; i < images.length; i++) {
                const parentSize = parents[i].offsetWidth;
                const size = (parentSize - images[i].offsetWidth) / 2;
                images[i].style.left = `${size}px`;
            }
        }
        
        window.onload = centerImages;
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
