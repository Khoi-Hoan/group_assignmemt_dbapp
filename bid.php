
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

    if(empty($document)){
      echo 'This auction does not exist';
    }
    else{
      if (date('y-m-d') > $document['closingDate']) {
        echo 'This auction is expired';
      }
      elseif ($amount < $document['minimunBid']) {
        echo 'The bid amount is too low';
      }
      elseif ($amount < $row['current']) {
        echo 'The bid amount is too low';
      }
      else{
        $sql1 = "INSERT INTO bid (Customer_Email, Auction_ID, Bid) values (?,?,?)";
        $stmt1 = $dbh->prepare($sql1);
        $result1 = $stmt1->execute([$_SESSION['User'], $id, $amount]);
      }
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
   <div>
    <input type="submit" name="back" value="Return main Page">
   </div>
</form>
