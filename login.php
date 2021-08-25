<?php

require_once 'db.php';

if (isset($_POST['act'])) {
  $email = $_POST['email'];
   $phone = $_POST['phone'];
    $password = $_POST['password'];

  $sql = "SELECT * FROM Customer WHERE(email='$email' or phone = '$phone')";
  $stmt = $dbh->query($sql);
  $row = $stmt->fetch(PSDO::FETCH_ASSOC);

  if ($row && password_verify($password, $row['password'])) {
    echo "<h2>Login successful. Welcome $username</h2>";
  } else {
    echo "<h2>Login failed.</h2>";
  }
}

?>

<form method="post">
  <div>
    <span>Username</span><br>
    <input type="text" name="phone or email">
   </div>
  <div>
    <span>Password</span><br>
    <input type="password" name="password">
   </div>
   <div>
    <input type="submit" name="act" value="Login">
   </div>
</form>
