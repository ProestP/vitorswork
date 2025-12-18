<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "<!DOCTYPE html><html><body style='background-color:green; color:white; text-align:center; font-family:Arial; font-size:22px;'>
          You must log in first. <a href='login.php' style='color:#00FFFF;'>Go to login</a></body></html>";
    exit;
}

$user = $_SESSION['username'];

$servername = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "shopping";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$thought = $_POST['thought'];

$sql = "INSERT INTO user_items (user, items) VALUES ('$user', '$thought')";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Store Content</title>
<style>
body {
  background-color: green;
  font-family: Arial, sans-serif;
  color: white;
  font-size: 24px;
  text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff;
  margin: 0;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}
a {
  color: #00FFFF;
  text-decoration: none;
  font-weight: bold;
  text-shadow: 0 0 8px #00ffff;
}
.footer-link {
  position: fixed;
  bottom: 20px;
}
</style>
</head>
<body>
  <div>
    <?php
    if ($conn->query($sql) === TRUE) {
        echo "Shopping item successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    ?>
  </div>
  <div class="footer-link">
    <a href="viewContent.php">View your shopping list</a>
  </div>
</body>
</html>