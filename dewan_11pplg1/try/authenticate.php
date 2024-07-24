<?php
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user from database
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header("Location: dashboard.php");
} else {
    echo "Invalid username or password.";
}
?>
