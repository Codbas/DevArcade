<?php
$host = 'localhost';
$dbName = 'DevArcade';
$user = 'root';
$password = '';

try {
    $dbConn = new PDO('mysql:host=' . $host . ';dbname=' . $dbName,  $user, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'connection to database failed: ' . $e->getMessage();
}