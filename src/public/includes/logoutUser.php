<?php session_start();
/* @var PDO $dbConn
 * @var bool $loggedIn
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'failed', 'error' => 'Invalid request']);
    exit();
}
if (!isset($_SESSION['username'], $_SESSION['sessionId'])) {
    echo json_encode(['status' => 'failed', 'error' => 'No session found']);
    exit();
}

require_once '../../includes/db.php';

$username = $_SESSION['username'];
$sessionId = $_SESSION['sessionId'];

$sql = 'delete from Sessions
where sessionId = :sessionId
';
$stmt = $dbConn->prepare($sql);
$stmt->bindParam(':sessionId', $sessionId);
$stmt->execute();

session_unset();
session_destroy();
$loggedIn = false;

if ($stmt->rowCount() > 0) {
    echo json_encode(['status' => 'success']);
}
else {
    echo json_encode(['status' => 'failed', 'error' => 'Failed to log out']);
}
