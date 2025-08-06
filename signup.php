<?php
// login.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; // connect to database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form and trim whitespace
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($username) || empty($email) || empty($password)) {
        echo "❌ All fields are required.";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "❌ Prepare failed: " . $conn->error;
        exit();
    }
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: login.html");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Invalid request.";
}
?>