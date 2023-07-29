<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "ERP";

// Create a MySQLi object
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Connected successfully
//echo "Connected to MySQL successfully!";
