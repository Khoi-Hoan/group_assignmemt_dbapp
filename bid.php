<form method="post">
   <div>
    <input type="submit" name="back" value="Return main Page">
   </div>
</form>

<?php
session_start();
require_once ('db.php');
require_once ('vendor/autoload.php');

if (isset($_POST['back'])){
  header("Location: view.php");
}

if (isset($_POST['bid'])){
    $id = $_POST['id'];
    $amount = $_POST['amount'];

    $client = new MongoDB\Client('mongodb://localhost:27017');
    $collection = $client->auction->auction;
    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
    $document = $collection->findOne($filter);

    $sql = "SELECT MAX(Bid) AS current FROM Bid WHERE Auction_ID = '$id'";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user = $_SESSION['User'];
    $sql1 = "SELECT Balance FROM Customer WHERE Customer_Email = '$user'";
    $stmt1 = $dbh->query($sql1);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    if(empty($document)){
      echo 'This auction does not exist';
    }
    elseif (date('Y-m-d') > $document['closingDate']) {
      echo date('Y-m-d') . $document['closingDate'];
      echo 'This auction is expired';
    }
    elseif ($amount < $document['minimunBid']) {
      echo 'The bid amount is too low';
    }
    elseif ($amount <= $row['current']) {
      echo 'The bid amount is too low';
    }
    elseif ($row1['Balance'] - $amount < 0) {
      echo 'Your Balance is to low to place this amount of bid';
    }
    else{
      echo 'Place bid Successfully';
      $sql2 = "INSERT INTO bid (Customer_Email, Auction_ID, Bid) values (?,?,?) ON DUPLICATE KEY UPDATE Bid = $amount";
      $stmt2 = $dbh->prepare($sql2);
      $result = $stmt2->execute([$user, $id, $amount]);
    }
}

?>
<form method="post">
  <div>
    <span>Auction ID</span><br>
    <input type="text" name="id">
   </div>
  <div>
    <span>Bid Amount</span><br>
    <input type="number" name="amount">
   </div>
   <div>
    <input type="submit" name="bid" value="Place Bid">
   </div>
</form>
