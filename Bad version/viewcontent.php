<?php
session_start();

/*
 NO authentication enforcement (BROKEN ACCESS CONTROL)
*/
$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';

/*
 IDOR: allow user override via GET
 Anyone can view anyone else’s data
*/
if (isset($_GET['user'])) {
    $user = $_GET['user'];
}

/*
 Database connection
*/
$conn = new mysqli("127.0.0.1", "root", "", "shopping");
if ($conn->connect_error) {
    die("Database error");
}

/*
 SQL Injection vulnerability
*/
$sql = "SELECT items FROM user_items WHERE user='$user'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<body style="background-color:green; text-align:center; font-family:Arial;">

<h2><?php echo strtoupper($user); ?>'S SHOPPING LIST</h2>

<?php
if ($result) {
    while ($row = $result->fetch_assoc()) {
       
        echo "<p>" . $row['items'] . "</p>";
    }
}
?>

<br>
<a href="addcontent.php">Add item</a>

</body>
</html>

<?php
$conn->close();
?>