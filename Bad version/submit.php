<?php
session_start();

$user = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$servername = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$dbname = "lab3";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM users WHERE username='$user' AND passwords='$password'";
$result = $conn->query($sql);

$message = '';
$link = '';


if ($result && $result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $name_from_db = $row['name'];

    $_SESSION['login'] = true;
    $_SESSION['username'] = $user;

    $message  = "Hello " . $name_from_db . "! (Logged in normally)";
    $message .= "<br>Session login: true";
    $message .= "<br>Session username: " . $user;

    $link = "<br><br><a href='viewContent.php'>View your shopping list</a>";
}


else {

    
    $_SESSION['login'] = true;
    $_SESSION['username'] = $user;

    $message  = "<b>Logged in with no validation!</b>";
    $message .= "<br>Your username: $user";
    $message .= "<br>Your password: $password";
    $message .= "<br>This should NOT be allowed!";

    $link = "<br><br><a href='viewContent.php'>Continue anyway</a>";
}

if (isset($_GET['msg'])) {
    echo "<p style='color:red;'>" . $_GET['msg'] . "</p>";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Submit</title>
<style>
body {
  background-color: green;
  font-family: Arial, sans-serif;
  color: black;
  margin: 0;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}
a {
  color: black;
  text-decoration: underline;
}
</style>
</head>
<body>
  <div>
    <?php echo $message; ?>
    <?php echo $link; ?>
  </div>
</body>
</html>
