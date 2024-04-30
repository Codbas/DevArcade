<?php
// Base class for Tiles
class Tile {
    private string $title;
    private string $description = 'Looks like no description exists...';

    function __construct(string $title /*, $dbConn */) {
        $this->title = $title;

        // TODO: $this->dbConn = $dbConn;

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