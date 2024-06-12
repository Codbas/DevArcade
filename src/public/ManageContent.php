<?php session_start();
/* @var bool $loggedIn
 *
 */
$title = 'Manage Content';

if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    exit('ERROR 401: Unauthorized');
}

require_once '../includes/config.php';

$username = $_SESSION['username'];
$sessionId = $_SESSION['sessionId'];

$gamesDir = '../../games';
$devlogsDir = '../../devlogs';

$games = json_encode(getDirArray($gamesDir));
$devlogs = json_encode(getDirArray($devlogsDir));

echo "<script>
    sessionStorage.setItem('games', '{$games}')
    sessionStorage.setItem('devlogs', '{$devlogs}')
    </script>";

function getDirArray(string $dir) : array {
    $dirList = [];
    if (is_dir($dir)) {
        $contents = array_diff(scandir($dir), ['.', '..']);
        foreach ($contents as $folder) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $folder)) {
                $dirList[] = $folder;
            }
        }
    }
    return $dirList;
}

require_once '../includes/siteHits.php';
require_once '../includes/pageViews.php';

echo '<body>
        <div id="page-container">
          <div id="content-wrap">
            <div class="container">
              <form id="upload-form" hx-post="includes/uploadContent.php" hx-encoding="multipart/form-data" hx-target="#upload-message" hx-swap="innerHTML" >
                <div class="upload-header">Upload</div>
                <div class="content-type-container">
                  <button id="uploadGameSelector" type="button" class="selected game-selector" onClick="setContentType(`game`, true)">Game</button>
                  <button id="uploadDevlogSelector" type="button" class="devlog-selector" onClick="setContentType(`devlog`, true)">Dev Log</button>
                </div>
                <div class="upload-container">
                  <div class="title-container">
                    <label for="title" id="title-label">Title</label>
                    <input class="textbox" type="text" id="upload-title" name="title" maxlength="40" minlength="6" pattern="^[A-Za-z0-9 !?\-,.]*$" title="Must be 6-40 characters and only include letters, numbers, spaces and punctuation !?-,." required>
                  </div>
                  <div class="description-container">
                    <label for="description" id="description-label">Description</label>
                    <input class="textbox" type="text" id="upload-description" name="description" maxlength="255" minlength="10" pattern="^[A-Za-z0-9 !?\-,.]*$" title="Must be 10-255 characters and only include letters, numbers, spaces and punctuation !?-,." required>
                  </div>
                </div>
                <div class="file-container">
                  <input type="file" id="fileInput" name="file" accept=".zip">
                  <img id="removeFile" alt="remove" src="../res/trash.svg">
                </div>
                <input class="button" type="submit" id="uploadContentButton" value="Upload">
                <div id="upload-message"></div>
                <input type="hidden" name="username" value="' . $username . '">
                <input type="hidden" name="sessionId" value="' . $sessionId . '">
                <input type="hidden" id="uploadContentType" name="contentType" value="game">
              </form>
            
              <form id="delete-form" hx-post="includes/deleteContent.php" hx-target="#delete-message" hx-swap="textContent" >
                <div class="delete-header">Delete</div>
                <div class="content-type-container">
                  <button id="deleteGameSelector" type="button" class="selected game-selector" onClick="setContentType(`game`, false)">Game</button>
                  <button id="deleteDevlogSelector" type="button" class="devlog-selector" onClick="setContentType(`devlog`, false)">Dev Log</button>
                </div>
                <div class="delete-container">
                    <select id="deleteSelect" name="deleteSelect"></select> 
                    <input class="button" type="submit" id="deleteContentButton" value="Delete">
                </div>
                <div id="delete-message"></div>
                <input type="hidden" name="username" value="' . $username . '">
                <input type="hidden" name="sessionId" value="' . $sessionId . '">
                <input type="hidden" id="deleteContentType" name="contentType" value="game">
              </form>
            </div>
';

include('../includes/footer.php');
