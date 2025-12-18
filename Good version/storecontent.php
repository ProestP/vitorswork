<?php

session_start();

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'");

if (!isset($_SESSION['login'])) {
    die("Unauthorized");
}

if (
    !isset($_POST['csrf']) ||
    !isset($_SESSION['csrf']) ||
    !hash_equals($_SESSION['csrf'], $_POST['csrf'])
) {
    http_response_code(403);
    die("CSRF validation failed");
}

$servername = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "shopping";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("DB error");
}

$user = $_SESSION['username'];
$thought = $_POST['thought'];

$stmt = $conn->prepare("INSERT INTO user_items (user, items) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $thought);
$stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<body style="background-color:green; text-align:center;">
<p>Item stored securely.</p>
<a href="viewContent.php">View list</a>
</body>
</html>