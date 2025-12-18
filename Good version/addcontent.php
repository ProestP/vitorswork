<?php

session_start();

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline'");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        !isset($_POST['csrf']) ||
        !isset($_SESSION['csrf']) ||
        !hash_equals($_SESSION['csrf'], $_POST['csrf'])
    ) {
        die("CSRF validation failed");
    }
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html>
<body style="background-color:green; text-align:center;">
<h2>Add Item</h2>

<form action="storeContent.php" method="post">
  <textarea name="thought" required></textarea><br><br>
  <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
  <input type="submit" value="Submit">
</form>

</body>
</html>