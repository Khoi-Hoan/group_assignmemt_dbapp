<form method="post">
   <div>
    <input type="submit" name="bid" value="Bid">
   </div>
   <div>
    <input type="submit" name="create" value="Create">
   </div>
</form>
<?php
require_once 'login.php';
require_once 'mongodb.php';

if (isset($_POST['bid'])){
  header('Location: bid.php');
}
if (isset($_POST['create'])){
  header('Location: create.php');
}

$document = $collection->find([]);

foreach ($document as $one) {
  foreach ($one as $key => $value) {
    if ($key == '_id'){
    echo 'ID : ' . $value . '<br>';
    }
    if ($key == 'poductName'){
    echo 'Product : ' . $value . '<br>';
    }
    if ($key == 'minimunBid'){
    echo 'Minimum Bid : ' . $value . '<br>';
    }
    if ($key == 'closingDate'){
    echo 'Closing Date: ' . $value . '<br>';
    }
    else {
    echo "$key : $val " . '<br>';
    }
  }
}
?>
