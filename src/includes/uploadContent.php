<?php session_start();
/* @var PDO $dbConn
 *
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("ERROR 401: Unauthorized");
}

if (!isset($_FILES['file'], $_POST['contentType'], $_POST['title'], $_POST['description'], $_POST['username'], $_POST['sessionId'])) {
    exit("ERROR 401: Unauthorized");
}

$contentType = $_POST['contentType'];
$title = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $_POST['title']);
$description = preg_replace('/[^a-zA-Z0-9 .,\-!?]/', '', $_POST['description']);
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

$title = trim($title);
$description = trim($description);

if (strlen($title) < 6 || strlen($title) > 50) {
    exit("ERROR: Title must be between 6 and 50 characters long.");
}
if (strlen($description) < 10 || strlen($description) > 255) {
    exit("ERROR: Description must be between 10 and 255 characters long.");
}

if ($_FILES['file']['size'] > 1_000_000 * 10) {
    exit('ERROR: File must be under 10MB.  (' . number_format($_FILES['file']['size'] / 1_000_000, 1) . 'MB)');
}

$fileExtension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
if ($fileExtension != 'zip') {
    exit("ERROR: only zip files are allowed.");
}


$zip = new ZipArchive;
if ($zip->open($_FILES['file']['tmp_name']) !== true) {
    exit("ERROR: the zip file could not be opened");
}

$macosFiles = false;
for ($i = $zip->numFiles - 1; $i >= 0; $i--) {
    $filename = $zip->getNameIndex($i);
    if (str_contains($filename, '__MACOSX')) {
        $zip->deleteIndex($i);
        $macosFiles = true;
    }
}

if ($macosFiles) {
    $zip->close();
    if ($zip->open($_FILES['file']['tmp_name']) !== true) {
        exit("ERROR: the zip file could not be opened");
    }
}

for ($i = $zip->numFiles - 1; $i >= 0; $i--) {
    $filename = $zip->getNameIndex($i);
    if (str_ends_with($filename, '/')) {
        exit('ERROR: zip cannot contain folders. Folder found: "' . substr($filename,0, (strlen($filename) - 1)) . '"');
    }
}


$requiredFiles = ['index.html'];
if ($contentType == 'game') {
    $requiredFiles[] = 'image.jpg';
}
$optionalFiles = ['index.js', 'styles.css'];
$zipFiles = [];
$missingFiles = [];
$extraFiles = [];

for ($i = 0; $i < $zip->numFiles; $i++) {
    $zipFiles[] = $zip->getNameIndex($i);
}

foreach ($requiredFiles as $file) {
    if (!in_array($file, $zipFiles)) {
        $missingFiles[] = $file;
    }
}

foreach ($zipFiles as $file) {
    if (!in_array($file, $requiredFiles) && !in_array($file, $optionalFiles)) {
        if (!($contentType == 'devlog' && (str_ends_with($file, '.jpg') || str_ends_with($file, '.png')))) {
            $extraFiles[] = $file;
        }
    }
}

if ($extraFiles) {
    if ($contentType == 'game') {
        exit("ERROR: zip contains extra files. Only index.html, index.js, styles.css, and image.jpg allowed.");
    }
    else {
        exit("ERROR: zip contains extra files. Only index.html, index.js, styles.css, and .jpg or .png images allowed.");
    }
}

if (!empty($missingFiles)) {
    exit('ERROR: required files are missing: ' . implode(', ', $missingFiles));
}

if ($contentType == 'game') {
    $table = 'Games';
    $extractDir = '../../games/' . $title . '/';
}
else {
    $title = 'Dev Log - ' . $title;
    $table = 'DevLogs';
    $extractDir = '../../devlogs/' . $title . '/';
}

$extraction_successful = true;

for ($i = 0; $i < $zip->numFiles; $i++) {
    $filename = $zip->getNameIndex($i);
    if (!$zip->extractTo($extractDir, $filename)) {
        $extraction_successful = false;
        break;
    }
}
$zip->close();

if (!$extraction_successful) {
    exit("ERROR: something went wrong during extraction.");
}


echo "<script>document.getElementById('upload-message').dispatchEvent(new Event('content-uploaded'));</script>";
echo "$contentType: $title uploaded.";


$sql = "insert into $table (title, description) (
    values(:title, :description)
    );";
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->execute();

if ($stmt->rowCount() != 1) {
    error_log("CRITICAL ERROR: Unable to execute SQL statement '$sql'. table: $table, title: $title, description: $description, contentType: $contentType");
}
