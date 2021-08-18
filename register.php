<?php
require_once('db.php')
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Register | PHP</title>
  </head>
  <body>
    <div>
      <?php
      if(isset($_POST['create'])){
        $email = $_POST['email']
        $phone = $_POST['phone']
        $firstname = $_POST['firstname']
        $lastname = $_POST['lastname']
        $password = $_POST['password']
        $address = $_POST['address']
        $city = $_POST['city']
        $country = $_POST['country']
        
      }
      ?>
    </div>
    <div>
      <form action="register.php" method="post">
        <div class="container">
          <h1>Register</h1>
          <p>Fill up the form with correct values.</p>
          <p><label for="email"><b>E-mail</b></label>
          <input type="email" name="email" required></p>

          <p><label for="phone"><b>Phone Number</b></label>
          <input type="text" name="phone" required></p>

          <p><label for="firstname"><b>First Name</b></label>
          <input type="text" name="firstname" required></p>

          <p><label for="lastname"><b>Last Name</b></label>
          <input type="text" name="lastname" required></p>

          <p><label for="password"><b>Password</b></label>
          <input type="password" name="password" required></p>

          <p><label for="address"><b>Address</b></label>
          <input type="text" name="address" required></p>

          <p><label for="city"><b>City</b></label>
          <input type="text" name="city" required></p>

          <p><label for="country"><b>Country</b></label>
          <input type="text" name="country" required></p>

          <p><input type="submit" name="create" value="Sign Up"</p>
        </div>
      </form>
    </div>
  </body>
</html>
