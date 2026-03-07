<?php
$dbName = "sweetwater_db";
$dbConnection = new mysqli("localhost", "root", "", $dbName);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

echo "Connected!";
?>