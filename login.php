<?php

require_once 'db.php';

if (isset($_POST['register'])){
  header('Location: http://localhost:8000/register.php');
}
if (isset($_POST['act'])) {
  $username = $_POST['user'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM Customer WHERE Customer_Email='$username' OR Phone='$username'";
  $stmt = $dbh->query($sql);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row && password_verify($password, $row['password'])) {
    echo "<h2>Login successful. Welcome $username</h2>";
    header("Location: aution.php");
  } else {
    echo "<h2>Login failed.</h2>";
    header("Location: http://localhost:8000/login.php");
  }
}

?>

<form method="post">
  <div>
    <span>User</span><br>
    <input type="text" name="user">
   </div>
  <div>
    <span>Password</span><br>
    <input type="password" name="password">
   </div>
   <div>
    <input type="submit" name="act" value="Login">
   </div>
   <div>
    <input type="submit" name="register" value="Sign up">
   </div>
</form>
