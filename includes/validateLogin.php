<?php
// This file is accessed via POST when a login attempt is made.
include('../includes/db.php');

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'cody' and $password == '1234') {
    echo "success";
}
else {
    echo "Incorrect username or password";
}

// TODO: create database connection

// TODO: check that ip address has not failed five logins in the past 10 minutes

// TODO: check that user is in database

// TODO: If user is found, salt and hash password and check for match

// TODO: successful login: create session token and add to database

// TODO: log ip address for successful or failed login

// TODO: failed login -> error message

// TODO: successful login -> successful login popup and redirect home