<?php
require 'db.php';

$sqlQuery = "SELECT comments FROM sweetwater_test";
$queryResult = $dbConnection->query($sqlQuery);

//empty arrays to store comments based on keywords
$commentsAboutCandy = [];
$commentsAboutCalls = [];
$commentsAboutReferrals = [];
$commentsAboutSignatures = [];
$miscellaneousComments = [];

//loop through the query results and categorize comments based on keywords
while ($currentRow = $queryResult->fetch_assoc()) {
    $commentLower = strtolower($currentRow['comments']);
    //boolean to track if any keyword matches were found for the current comment
    $keywordMatchFound = false;

    if (str_contains($commentLower, 'candy')) {
        $commentsAboutCandy[] = $currentRow['comments'];
        $keywordMatchFound = true;
    }
    if (str_contains($commentLower, 'call')) {
        $commentsAboutCalls[] = $currentRow['comments'];
        $keywordMatchFound = true;
    }
    if (str_contains($commentLower, 'referred') || str_contains($commentLower, 'referral')) {
        $commentsAboutReferrals[] = $currentRow['comments'];
        $keywordMatchFound = true;
    }
    if (str_contains($commentLower, 'signature')) {
        $commentsAboutSignatures[] = $currentRow['comments'];
        $keywordMatchFound = true;
    }
    if (!$keywordMatchFound) {
        $miscellaneousComments[] = $currentRow['comments'];
    }
}

//function to render comments in a list
function renderAllComments(string $title, array $comments)
{
    echo "<h2>$title</h2>";
    echo "<ul>";
    foreach ($comments as $comment) {
        echo "<li>" . htmlspecialchars($comment) . "</li>";
    }
    echo "</ul>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweetwater Comments</title>
</head>

<body>
    <h1>Official Sweetwater Comment Report</h1>
    <?php
    renderAllComments("Comments about Candy", $commentsAboutCandy);
    renderAllComments("Comments about Calls", $commentsAboutCalls);
    renderAllComments("Comments about Referrals", $commentsAboutReferrals);
    renderAllComments("Comments about Signatures", $commentsAboutSignatures);
    renderAllComments("Miscellaneous Comments", $miscellaneousComments);
    ?>
</body>

</html>