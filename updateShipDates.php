<?php
require 'db.php';

$sqlQuery =
    "SELECT *
     FROM sweetwater_test
     WHERE shipdate_expected = '0000-00-00 00:00:00'";

$queryResult = $dbConnection->query($sqlQuery);

while ($currentRow = $queryResult->fetch_assoc()) {
    $currentComment = $currentRow['comments'];
    if (str_contains(strtolower($currentComment), 'expected ship date')) {
        //find the position of the colon in the comment
        $positionOfColon = strpos($currentComment, ':');
        //extrat the date from the comment and remove any whitespace
        $extractedDate = trim(substr($currentComment, $positionOfColon + 1));
        //format the date to be compatible with the database
        $formattedDate = parseDateFromComment($extractedDate);
        //run query to update the ship date for the current order
        $dbConnection->query("UPDATE sweetwater_test SET shipdate_expected = '$formattedDate' WHERE orderid = '" . $currentRow['orderid'] . "'");
        // Inform the user that this row has been updated
        echo "Updated order <strong>{$currentRow['orderid']}</strong> with shipping date <strong>$formattedDate</strong><br>";
    }
}
echo "</strong>All Shipping dates updated successfully.</strong>";

function parseDateFromComment(string $extractedDate): string
{
    $date = strtotime($extractedDate);
    return date('Y-m-d', $date);
}
