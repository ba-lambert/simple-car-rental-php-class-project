<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "student_registration"; 
$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$level = $_POST['level'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];

$sql = "INSERT INTO students (first_name, last_name, level, age, gender, dob)
        VALUES ('$first_name', '$last_name', '$level', $age, '$gender', '$dob')";

if ($conn->query($sql) === TRUE) {
    echo "New student record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
