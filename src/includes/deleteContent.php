<?php session_start();
/* @var PDO $dbConn
 *
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    exit("ERROR 401: Unauthorized");
}

if (!isset($_POST['deleteSelect'], $_POST['contentType'], $_POST['username'], $_POST['sessionId'])) {
    exit("ERROR 401: Unauthorized");
}

$contentTitle = $_POST['deleteSelect'];
$contentType = $_POST['contentType'];
$sessionId = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['sessionId']);
$username = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['username']);

if (strlen($username) > 20 || strlen($sessionId) > 255 ) {
    exit("ERROR 401: Unauthorized");
}

if ($contentType !== 'game' && $contentType !== 'devlog') {
    exit("ERROR 401: Unauthorized");
}

include_once 'db.php';

$sql = 'select count(*)
        from Sessions
        where username = :username and sessionId = :sessionId';
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':sessionId', $sessionsId);
$stmt->execute();

if ($stmt->rowCount() != 1) {
    exit("ERROR 401: Unauthorized");
}

if (strlen($contentTitle) > 50) {
    exit("ERROR: {$contentTitle} is not a valid title.");
}

$pattern = '/[^a-zA-Z0-9 .,\-!]/';
$contentTitle = preg_replace($pattern, '', $_POST['deleteSelect']);

if (strlen($contentTitle) < 6) {
    exit("ERROR: {$contentTitle} is not a valid title.");
}

//$baseDir = '/var/www/' . $contentType . 's/'; /* Docker dir */
$baseDir = '/Users/Peligro/My Drive/School/2024/Spring 2024/CS421 - Software Development Capstone/Assignments/Project/DevArcade/' . $contentType . 's/'; /* MacOS IDE dir */
$fullPath = realpath($baseDir . DIRECTORY_SEPARATOR . $contentTitle);

if ($fullPath && !str_starts_with($fullPath, realpath($baseDir))) {
    exit("ERROR: {$contentTitle} does not exist...");
}

if (!is_dir($fullPath)) {
    exit("ERROR: {$contentTitle} does not exist...");
}

// Can finally delete those files...!


if (deleteDirectory($fullPath)) {
    echo "<script>document.getElementById('delete-message').dispatchEvent(new Event('content-deleted'));</script>";
    echo "$contentType: $contentTitle deleted.";
} else {
    echo "ERROR: Failed to delete $contentType: $contentTitle.";;
}

if ($contentType == 'game') {
    $table = 'Games';
}
else {
    $table = 'DevLogs';
}

$sql = "delete from $table
        where title = :title";
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':title', $contentTitle);
$stmt->execute();

if ($stmt->rowCount() != 1) {
    error_log("CRITICAL ERROR: Unable to execute SQL statement '$sql'. table: $table, title: $contentTitle. contentType: $contentType");
}

function deleteDirectory($dir) : bool {
    if (!file_exists($dir)) {
        return false;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    $items = array_diff(scandir($dir), ['.', '..']);
    foreach ($items as $item) {
        deleteDirectory($dir . DIRECTORY_SEPARATOR . $item);
    }
    return rmdir($dir);
}
