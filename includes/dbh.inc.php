<?php
// to handle database connections
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "auth";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

// if connection fails
if (!$conn) {
    // kill the connection
    die("Connection failed " . mysqli_connect_error());
}