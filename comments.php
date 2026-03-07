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
    $checkForCommentType = strtolower($currentRow['comments']);

    if (str_contains($checkForCommentType, 'candy')) {
        $commentsAboutCandy[] = $currentRow['comments'];
    } elseif (str_contains($checkForCommentType, 'call')) {
        $commentsAboutCalls[] = $currentRow['comments'];
    } elseif (str_contains($checkForCommentType, 'referred') || str_contains($checkForCommentType, 'referral')) {
        $commentsAboutReferrals[] = $currentRow['comments'];
    } elseif (str_contains($checkForCommentType, 'signature')) {
        $commentsAboutSignatures[] = $currentRow['comments'];
    } else {
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