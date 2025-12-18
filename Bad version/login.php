<!DOCTYPE html>
<html>
<head>
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
}
input[type="submit"] {
  background-color: black;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
  cursor: pointer;
}
form {
  text-align: left;
}
</style>
</head>
<body>

<?php

if (isset($_GET['error'])) {
    echo "<p style='color:red; font-weight:bold;'>" . $_GET['error'] . "</p>";
}
?>

<h2>Login</h2>
<form action="submit.php" method="post">

  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>

  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username"><br>

  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>

  <input type="submit" value="Submit">
</form>

</body>
</html>
