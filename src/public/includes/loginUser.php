<?php session_start();
/* @var PDO $dbConn
 *
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "ERROR 401: Unauthorized";
    exit();
}
if (!isset($_POST['username'], $_POST['password'])) {
    echo "<p style='color: red;'>Username or Password cannot be blank</p>";
    exit();
}

include('../../includes/db.php');
include('../../includes/authUser.php');

$username = $_POST['username'];
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];

if (strlen($username) < 4 || strlen($username) > 20 ||
    strlen($password) < 8 || strlen($password) > 24 ||
    !preg_match('/^[A-Za-z0-9!@#$%^&*()?.-]{8,24}$/', $password)) {
    echo "<p style='color: red;'>Invalid username or password</p>";
    exit();
}

$username = preg_replace('/[^a-zA-Z0-9]/', '', $username);

$response = authenticateUser($dbConn, $username, $password, $ip);
$responseData = json_decode($response, true);

if ($responseData === null) {
    echo "<p style='color: red;'>ERROR: 1220</p>";
    exit();
}

if ($responseData['status'] === 'failed') {
    echo "<p style='color: red;'>{$responseData['error']}</p>";
    exit();
}
else if ($responseData['status'] === 'success') {
    session_regenerate_id();
    $_SESSION['username'] = $username;
    $_SESSION['sessionId'] = session_id();

    $sql = 'delete from Sessions where username = :username';
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $sql = 'insert into SuccessfulLogin(timestamp, ip, username) (
                values(now(), :ip, :username))';
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(':ip', $ip);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $sql = 'insert into Sessions(sessionId, lastActive, userName) (
                values(:sessionId, now(), :username))';
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(':sessionId', $_SESSION['sessionId']);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    echo '<p style="color: green;">Login successful. You will be redirected in 2 seconds...</p>';
    echo '<script>
        setTimeout(function() {
            window.location.href="Home.php";
        }, 2000);
        </script>';
}
else {
    // shouldn't happen
    echo "<p style='color=red;'>Unknown Error: {$responseData['error']}</p>";
}
