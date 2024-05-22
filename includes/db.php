<?php
$host = 'localhost';
$dbName = 'DevArcade';
$user = 'root';
$password = '';

try {
    $dbConn = new PDO('mysql:host=' . $host . ';dbname=' . $dbName,  $user, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log('connection to database failed: ' . $e->getMessage());
    echo 'ERROR: 1000<br>';
    echo 'If this error persists, contact the website administrator.';
    exit();
}