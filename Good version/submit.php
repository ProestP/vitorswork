<?php

session_start();

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'");

$servername = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "lab3";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("DB error");
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT name FROM users WHERE username = ? AND passwords = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: viewContent.php");
    exit;
} else {
    echo "Invalid login";
}

$stmt->close();
$conn->close();