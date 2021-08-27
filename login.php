<?php

require_once 'db.php';

if (isset($_POST['act'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM Customer WHERE(email='$email')";
  $stmt = $dbh->query($sql);
  $row = $stmt->fetch(PSDO::FETCH_ASSOC);

  if ($row && password_verify($password, $row['password'])) {
    echo "<h2>Login successful. Welcome $username</h2>";
    header("Location: .php");
  } else {
    echo "<h2>Login failed.</h2>";
    header("Location: login.php");
  }
}

?>

<form method="post">
  <div>
    <span>Email</span><br>
    <input type="email" name="email" required>
   </div>
  <div>
    <span>Password</span><br>
    <input type="password" name="password" required>
   </div>
   <div>
    <input type="submit" name="act" value="Login">
   </div>
</form>
