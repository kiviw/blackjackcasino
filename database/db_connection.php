<?php
// Database connection parameters
$servername = "localhost"; // Replace with your MySQL server name
$username = "your_username"; // Replace with your MySQL username
$password = "your_password"; // Replace with your MySQL password
$database = "your_database"; // Replace with the name of your database

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8");
?>
