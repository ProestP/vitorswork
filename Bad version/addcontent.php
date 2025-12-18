<?php

session_start();
?>
<!DOCTYPE html>
<html>
<body style="background-color:green; font-family:Arial; color:black; text-align:center;">
<h2>Add a new shopping item!</h2>

<form action="storeContent.php" method="post">
  <label for="thought">Add an item!</label><br><br>
  <textarea name="thought" rows="4" cols="40"></textarea><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
