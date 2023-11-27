<?php
session_start();

require_once "vendor/autoload.php"; // Include the MongoDB PHP library

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->guvi;
$collection = $database->users;

$userId = $_SESSION['user_id'];

$userData = $collection->findOne(["_id" => new MongoDB\BSON\ObjectID($userId)]);

// Display user profile data
echo "<h2>Updated Profile</h2>";
echo "<p><strong>Address:</strong> " . $userData['address'] . "</p>";
echo "<p><strong>State:</strong> " . $userData['state'] . "</p>";
echo "<p><strong>Country:</strong> " . $userData['country'] . "</p>";
echo "<p><strong>Aadhar Number:</strong> " . $userData['aadharNumber'] . "</p>";
?>
