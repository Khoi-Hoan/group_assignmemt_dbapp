<?php
$pass = "";

$dbh = new PDO('mysql:host=localhost;dbname=auction', $_SESSION['db_user'], $pass);
