<?php
session_start();
$_SESSION['db_user'] = 'signinnup';

require_once 'db.php';

if (isset($_POST['register'])){   //move user to register page
  header('Location: register.php');
}
if (isset($_POST['act'])) {   //if the hav an account they can fill in with eith phone number or email together with pass word to login
  $username = $_POST['user'];
  $password = $_POST['password'];
  if ($username == 'admin' && $password == 'admin'){    //admin account
    $_SESSION["User"] = 'admnin';
    $_SESSION['db_user'] = 'auctionadmin';
    header("Location: adminview.php");
  }
  else{   //regular user account
    $sql = "SELECT * FROM Customer WHERE Customer_Email='$username' OR Phone='$username'";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['Password'])) {
      $_SESSION["User"] = $row['Customer_Email'];
      $_SESSION['db_user'] = 'auctionguest';
      header("Location: view.php");
    }
    else {
      echo "<p>Login failed. Please try again<p>";
  }
  }
}

?>

<form method="post">
  <h2>Login</h2>
  <div>
    <b>User</b><br>
    <input type="text" name="user">
   </div>
  <div>
    <b>Password</b><br>
    <input type="password" name="password">
   </div>
   <div>
    <input type="submit" name="act" value="Login">
    <input type="submit" name="register" value="Sign up">
   </div>
</form>
