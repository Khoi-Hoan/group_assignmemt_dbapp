<?php
require_once('db.php')
?>
  <body>
    <div>
      <?php
      if(isset($_POST['create'])){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $branch = $_POST['branch'];
        $profile = $_POST['profile'];

        $sql = "insert into customer (Customer_Email,Branch_Code , Password, Phone, First_Name, Last_Name, Customer_ID, Address, City, Country, Balance, Profile_Picture) values (?,?,?,?,?,?,?,?,?,?, 0.00,?)";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute([$email,$branch , $hash, $phone, $firstname, $lastname, $id, $address, $city, $country, $profile]);
        if ($result){
          echo 'Create an account Successfully';
          header('Location: login.php');
        }
      }
      ?>
    </div>
    <div>
      <form method="post">
        <div>
          <h1>Register</h1>
          <p>Fill up the form with correct values.</p>
          <p><label for="email"><b>E-mail</b></label>
          <input type="email" name="email" required></p>

          <p><label for="phone"><b>Phone Number</b></label>
          <input type="text" name="phone" required></p>

          <p><label for="id"><b>National ID</b></label>
          <input type="text" name="id" required></p>

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

          <p><label for="branch"><b>Choose a branch:</b></label>
            <select name="branch" id="branch" required>
            <option value="as">Asia</option>
            <option value="eu">Europe</option>
            <option value="na">North America</option>
            <option value="sa">South America</option>
            <option value="oc">Oceania</option>
          </select></p>

          <p><label for="profile">Profile picture:</label>
          <input type="file" name="profile" accept="image/png, image/jpeg"></p>

          <p><input type="submit" name="create" value="Sign Up"</p>
        </div>
      </form>
    </div>
  </body>
</html>
