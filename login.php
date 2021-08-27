<?php

require_once 'db.php';

if (isset($_POST['register'])){
  header('Location: http://localhost:8000/register.php');
}
if (isset($_POST['act'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM Customer WHERE email='$email'";
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
    <span>Email</span><br>
    <input type="email" name="email">
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
