<?php

$user = "root";
$pass = "";

global $dbh;

$dbh = new PDO('mysql:host=localhost;dbname=auction', $user, $pass);
