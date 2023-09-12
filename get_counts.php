<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of users
$userCount = 0;
$userResult = $conn->query("SELECT COUNT(*) as user_count FROM users");
if (!$userResult) {
    die("Error in user query: " . $conn->error);
}
if ($userResult) {
    $userRow = $userResult->fetch_assoc();
    $userCount = $userRow['user_count'];
}

// Get the number of clients
$clientCount = 0;
$clientResult = $conn->query("SELECT COUNT(*) as client_count FROM client");
if (!$clientResult) {
    die("Error in client query: " . $conn->error);
}
if ($clientResult) {
    $clientRow = $clientResult->fetch_assoc();
    $clientCount = $clientRow['client_count'];
}

$conn->close();

// Create an array to hold the counts
$counts = array(
    'userCount' => $userCount,
    'clientCount' => $clientCount
);

// Convert the array to JSON format
echo json_encode($counts);
?>
