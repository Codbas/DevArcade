<?php
function authenticateUser($dbConn, $username, $password, $ip) : string {

    // check ip address has not failed too many login attempts
    $sql = 'select count(*) as failed
            from FailedLogin
            where ip = :ip and timestamp >= now() - interval 10 minute';
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(':ip', $ip);
    $stmt->execute();
    $result = $stmt->fetch()['failed'];

    if ($result >= 5) {
        return json_encode(['status' => 'failed', 'error' => "Too many failed login attempts"]);
    }

    // find user and check that their password matches
    $sql = 'select password
            from Users
            where username = :username';
    $stmt = $dbConn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
        $result = $row['password'];
    }
    else {
        $result = false;
    }

    $failedLogin = false;
    if (!$result) {
        $failedLogin = true;
    }
    else if (!password_verify($password, $result)) {
        $failedLogin = true;
    }

    if ($failedLogin) {
        $sql = 'insert into FailedLogin(timestamp, ip)
                values(now(), :ip)';
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(':ip', $ip);
        $stmt->execute();
        return json_encode(['status' => 'failed', 'error' => "Invalid username or password"]);
    }

    return json_encode(['status' => 'success']);
}
