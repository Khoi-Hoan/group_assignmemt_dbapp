<?php
require_once('mongodb.php');
require_once('login.php');
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

        $name = $_POST['name'];
        $minimum = $_POST['minimum'];
        $date = $_POST['date'];
        $f1 = $_POST['f1'];
        $v1 = $_POST['v1'];
        $f2 = $_POST['f2'];
        $v2 = $_POST['v2'];
        $f3 = $_POST['f3'];
        $v3 = $_POST['v3'];
        $f4 = $_POST['f4'];
        $v4 = $_POST['v4'];
        $f5 = $_POST['f5'];
        $v5 = $_POST['v5'];

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $res = $collection->insertOne([
           'productName' => $name,
           'minimunBid' => $minimum,
           'closingDate' = >$date,
           'ownerEmail' => $row['Customer_Email'],
           $f1 = $v1,
           $f2 = $v2,
           $f3 = $v3,
           $f4 = $v4,
           $f5 = $v5
        ]);

      ?>
    </div>
    <div>
      <form method="post">
        <div>
          <h1>Create an auction</h1>
          <p>Fill up the form with correct values.</p>

          <p><label for="name"><b>Product name</b></label>
          <input type="text" name="name" required></p>

          <p><label for="minimun"><b>Minimum bid amount</b></label>
          <input type="number" name="minimum" required></p>

          <p><label for="date"><b>Closing date</b></label>
          <input type="date" name="date" required></p>

          <p>Extra infomation field and values</p>

          <p><input type="text" name="f1"><b>:</b><input type="text" name="v1"></p>
          <p><input type="text" name="f2"><b>:</b><input type="text" name="v2"></p>
          <p><input type="text" name="f3"><b>:</b><input type="text" name="v3"></p>
          <p><input type="text" name="f4"><b>:</b><input type="text" name="v4"></p>
          <p><input type="text" name="f5"><b>:</b><input type="text" name="v5"></p>

          <p><input type="submit" name="create" value="create"</p>
        </div>
      </form>
    </div>
  </body>
</html>
