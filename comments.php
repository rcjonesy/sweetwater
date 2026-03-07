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
