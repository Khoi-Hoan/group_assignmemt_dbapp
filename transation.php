<?php
session_start();
 ?>

 <form method="post">
    <div>
     <input type="submit" name="back" value="Return main Page">
    </div>
 </form>

<?php
if ($_SESSION['User'] == 'admin'){
  require_once 'db.php';
  require_once 'vendor/autoload.php';
  $client = new MongoDB\Client('mongodb://localhost:27017');
  $collection = $client->auction->auction;

  if (isset($_POST['back'])){
    header("Location: view.php");
  }
  
  if (isset($_POST['add'])){
    $user = $_POST['user'];
    $amount = $_POST['amount'];

    $sql2 = "SELECT Balance FROM Customer WHERE Customer_Email = '$user'";
    $stmt2 = $dbh->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    $sql = "UPDATE Customer SET Balance = Balance + $amount WHERE Customer_Email = '$user'";
    $stmt = $dbh->query($sql);

    $sql1 = "SELECT Customer_Email, Balance FROM Customer WHERE Customer_Email = '$user'";
    $stmt1 = $dbh->query($sql1);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    echo $row1['Customer_Email'] . " Balance: " . $row2['Balance'] . " => " . $row1['Balance'];
  }

  if (isset($_POST['delete'])){
    $id = $_POST['id'];

    $doc = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    $sql = "DELETE FROM bid WHERE Auction_ID = '$id'";
    $stmt = $dbh->query($sql);

    echo 'Auction: ' . $id . "has been deleted.";
  }
}
else {
  header('Location: login.php');
  echo 'You have to login first';
}
?>

<form method="post">
  <div>
    <h2>Add Money To An Account:</h2>
    <span>User Email:</span> <input type="text" name="user"><br>
    <span>Add:</span> <input type="number" name="amount"><br>
    <input type="submit" name="add" value="Add To Account"><br>
  </div>
  <div>
    <h2>Delete An Auction:</h2>
    <span>Aution ID: </span> <input type="text" name="id"><br>
    <input type="submit" name="delete" value="Delete Auction"><br>
  </div>
</form>
