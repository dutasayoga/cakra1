<?php
date_default_timezone_set('Asia/Jakarta');

SESSION_START();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cakra1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
