<?php
// Base class for Tiles
class Tile {
    protected string $title;
    protected string $description = 'Looks like no description exists...';
    protected PDO $dbConn;

    function __construct(string $title, $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }
}
