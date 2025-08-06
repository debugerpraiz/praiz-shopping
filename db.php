<?php
$host = 'localhost';
$db   = 'ecommerce';
$user = 'root';
$pass = ''; // or your MySQL password
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Set the character set to utf8mb4
if (!$conn->set_charset($charset)) {
    die("Error loading character set $charset: " . $conn->error);
}
?>
