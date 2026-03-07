<?php
require 'db.php';

$sqlQuery =
    "SELECT *
     FROM sweetwater_test
     WHERE shipdate_expected = '0000-00-00 00:00:00'";

$queryResult = $dbConnection->query($sqlQuery);

while ($currentRow = $queryResult->fetch_assoc()) {
    $currentComment = $currentRow['comments'];
    // only process rows that contain an expected ship date in the comment
    if (str_contains(strtolower($currentComment), 'expected ship date')) {
        //find the position of the colon in the comment and extract the date that follows it
        $positionOfColon = strpos($currentComment, ':');
        $extractDate = substr($currentComment, $positionOfColon + 1);
        $date = strtotime($extractDate);
        // format it for SQL
        $formattedDate = date('Y-m-d', $date);
        //run query to update the ship date for the current order
        $dbConnection->query("UPDATE sweetwater_test SET shipdate_expected = '$formattedDate' WHERE orderid = '" . $currentRow['orderid'] . "'");
    }
}
echo "Ship dates updated successfully.";
