<?php
// Inside register.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');
// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$database = "guvi";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Uncomment the following line if you want to set the character set
// $conn->set_charset("utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    // Implement registration logic using prepared statements
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, country, email, phone, age, dob, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisss", $firstname, $lastname, $country, $email, $phone, $age, $dob, $username, $hashedPassword);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        // Handle database error
        echo 'error: ' . $stmt->error;
    }

    $stmt->close();
}
// Close the database connection
$conn->close();
?>
