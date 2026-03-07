<?php
require 'db.php';

$sqlQuery =
    "SELECT id, comments
     FROM sweetwater_test
     WHERE shipdate_expected = '0000-00-00 00:00:00'";

$queryResult = $dbConnection->query($sqlQuery);
