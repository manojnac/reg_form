<?php
// Submit form data to MySQL database
$servername = "localhost";
$username = "root"; // default XAMPP MySQL username
$password = ""; // default XAMPP MySQL password
$dbname = "users"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, mobile_number, email, password, dob, gender, country, bio, newsletter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi", $firstName, $lastName, $mobileNumber, $email, $password, $dob, $gender, $country, $bio, $newsletter);

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$mobileNumber = $_POST['mobilenumber'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$bio = $_POST['bio'];
$newsletter = isset($_POST['newsletter']) ? 1 : 0;

// Execute statement
if ($stmt->execute()) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
