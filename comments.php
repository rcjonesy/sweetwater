<?php
require 'db.php';

$sqlQuery = "SELECT * FROM sweetwater_db";
$queryResult = $dbConnection->query($sqlQuery);

$candyComments = [];
$callComments = [];
$referralComments = [];
$signatureComments = [];
$miscellaneousComments = [];

echo "<h1>Comments</h1>";