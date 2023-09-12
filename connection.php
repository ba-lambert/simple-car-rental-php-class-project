<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "carrental"; 
$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO client (fullNames, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $fullNames, $email, $message);
$fullNames = $_POST['names'];
$email = $_POST['email'];
$message = $_POST['message'];
if ($stmt->execute()) {
    echo "<div class='success'>New client record created successfully</div>";
} else {
    echo "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
}

$stmt->close();
$conn->close();
?>