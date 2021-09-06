<?php
session_start();
?>
<form method="post">
   <div>
    <input type="submit" name="bid" value="Bid">
    <input type="submit" name="create" value="Create">
    <input type="submit" name="logout" value="Log Out">
   </div>
</form>
<?php
if($_SESSION['User'] == 'admin'){
  header('Location: adminview.php');
}
require_once ('db.php');
require_once ('vendor/autoload.php');
$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->auction->auction;

if (isset($_POST['bid'])){
  header('Location: bid.php');
}
if (isset($_POST['create'])){
  header('Location: create.php');
}
if (isset($_POST['logout'])){
  header('Location: logout.php');
}

$document = $collection->find([]);

echo '_____________________________________________ <br> <br>';
foreach ($document as $one) {
    $id = $one['_id'];
    $sql = "SELECT MAX(Bid) AS current FROM Bid WHERE Auction_ID = '$id'";
    $stmt = $dbh->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'ID : ' . $one['_id'] . '<br>';
    echo 'Product : ' . $one['productName'] . '<br>';
    echo 'Minimum Bid : ' . $one['minimunBid'] . '<br>';
    if ($row && $row['current'] != null){
      echo 'Current highest: ' . $row['current']. '<br>';
    }
    else {
      echo 'Current highest: ' . $one['minimunBid'] . '<br>';
    }
    echo 'Closing Date: ' . $one['closingDate'] . '<br>';
    echo 'Seller: ' . $one['ownerEmail'] . '<br>';
    echo '_____________________________________________ <br> <br>';
}
?>
