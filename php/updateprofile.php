<?php
session_start();

require_once "vendor/autoload.php"; // Include the MongoDB PHP library

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->guvi;
$collection = $database->users;

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST["address"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $aadharNumber = $_POST["aadharNumber"];

    $result = $collection->updateOne(
        ["_id" => new MongoDB\BSON\ObjectID($userId)],
        [
            '$set' => [
                "address" => $address,
                "state" => $state,
                "country" => $country,
                "aadharNumber" => $aadharNumber,
            ]
        ]
    );

    if ($result->getModifiedCount() > 0) {
        echo 'success';
    } else {
        echo 'error: Failed to update profile.';
    }
}
?>
