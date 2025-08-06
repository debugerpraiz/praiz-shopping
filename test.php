<?php
$mysqli = new mysqli("localhost", "root", "", "ecommerce");

if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
}
echo "✅ Connected to database!";
?>
