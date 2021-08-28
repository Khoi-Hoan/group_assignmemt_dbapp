<?php


	require_once 'db.php';

if (isset($_POST['register'])){
  header('Location: http://localhost:8000/register.php');

	if(ISSET($_POST['login'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM Customer WHERE Customer_Email='$username' OR Phone='$username'";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();


			if($row > 0) {
				$_SESSION['user'] = $fetch['mem_id'];
				header("location: aution.php");
			} else{
    echo "<h2>Login failed.</h2>";
    header("Location: http://localhost:8000/login.php");
			}
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
