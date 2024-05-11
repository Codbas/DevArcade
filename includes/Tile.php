<?php
// Base class for Tiles
class Tile {
    protected string $title;
    protected string $description = 'Looks like no description exists...';
    protected $dbConn;

    function __construct(string $title , $dbConn) {
        $this->title = $title;
        $this->dbConn = $dbConn;

        // TODO: Get description from the database and assign to $description
    }
    function getTitle() : string {
        return $this->title;
    }
    function getDescription() : string {
        return $this->description;
    }
}
?>