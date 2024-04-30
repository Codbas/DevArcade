<?php
// This class handles file uploads for dev logs and games
class File {
    private string $errorMessage;
    private string $fileName;

    function __construct(string $fileName) {
        $this->fileName = $fileName;
    }

    public function upload() : bool {
        // TODO: unzip file and verify file contents meet file structure requirements

        // TODO : check if file with same name already exists on server. if it does, overwrite them

        // TODO: upload files to directory
        return true;
    }

    public function delete(string $title) : bool {
        // TODO: verify that file is in the /Games or /DevLogs directory

        // TODO: move files to the /Deleted/Games or /Deleted/DevLogs directory
        return true;
    }
    private function validContents(/* file contents*/) : bool {
        // TODO: logic to check that contents are valid
        return true;
    }

}
?>