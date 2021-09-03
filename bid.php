
<?php
session_start();
require_once ('db.php');
require_once ('vendor/autoload.php');
$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->auction->auction;
if (isset($_POST['back'])){
  header("Location: view.php");
}

if (isset($_POST['bid'])){
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $document = $collection->find([ '_id' => $id ]);

    $sql = "";
    $stmt = $dbh->prepare($sql);
    $result = $stmt->execute([]);

    if(empty($document)){
      echo 'This auction does not exist';
    }
    foreach ($document as $one) {

      if (date('y-m-d') > $one['closingDate']) {
        echo 'This auction is expired';
      }
      elseif ($amount < $one['minimunBid']) {
        echo 'The bid amount is too low';
      }
      elseif ($amount < ) {

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
