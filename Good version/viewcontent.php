<?php
session_start();


if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    die("Unauthorized");
}


if (isset($_GET['user']) && $_GET['user'] !== $_SESSION['username']) {
    http_response_code(403);
    die("Unauthorized");
}

$user = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !isset($_POST['csrf']) ||
        !isset($_SESSION['csrf']) ||
        !hash_equals($_SESSION['csrf'], $_POST['csrf'])
    ) {
        die("CSRF validation failed");
    }
}

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'");


$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';


if (isset($_GET['user'])) {
    $user = $_GET['user'];
}


$conn = new mysqli("127.0.0.1", "root", "", "shopping");
if ($conn->connect_error) {
    die("Database error");
}

$stmt = $conn->prepare(
    "SELECT items FROM user_items WHERE user = ?"
);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<body style="background-color:green; text-align:center; font-family:Arial;">

<h2><?php echo htmlspecialchars(strtoupper($user), ENT_QUOTES, 'UTF-8'); ?>'S SHOPPING LIST</h2>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($row['items'])) {
            echo "<p>" . htmlspecialchars((string)$row['items'], ENT_QUOTES, 'UTF-8') . "</p>";
        }
    }
}
?>

<br>
<a href="addcontent.php">Add item</a>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>