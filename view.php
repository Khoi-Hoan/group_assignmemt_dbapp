<?php
session_start();
?>
<form method="post">
   <div>
    <input type="submit" name="bid" value="Bid">
    <input type="submit" name="create" value="Create">
   </div>
</form>
<?php

require_once 'vendor/autoload.php';
$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->auction->aution

if (isset($_POST['bid'])){
  header('Location: bid.php');
}
if (isset($_POST['create'])){
  header('Location: create.php');
}

$document = $collection->find([]);

foreach ($document as $one) {
    echo 'ID : ' . $one['_id'] . '<br>';
    echo 'Product : ' . $one['productName'] . '<br>';
    echo 'Minimum Bid : ' . $one['minimunBid'] . '<br>';
    echo 'Closing Date: ' . $one['ownerEmail'] . '<br>';
}
?>
