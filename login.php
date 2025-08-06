<?php

include 'db.php'; // Use the shared database connection

// Validate input
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
} else {
    echo "❌ Please enter both username and password.";
    exit();
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "❌ Prepare failed: " . $conn->error;
    exit();
}
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verify password (assuming it's hashed)
    if (password_verify($password, $row['password'])) {
        // ✅ Redirect to the main e-commerce page
        header("Location: praiz.html");
        exit();
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ User not found.";
}

$stmt->close();
$conn->close();
?>