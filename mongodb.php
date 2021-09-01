<?php

require_once 'vendor/autoload.php';

global $client;
global $collection;

$client = new MongoDB\Client('mongodb://localhost:27017');
$collection = $client->auction->aution;
