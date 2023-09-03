<?php
// Database Configuration
$host = 'localhost'; // Your database host (often 'localhost' or an IP address)
$username = 'your_db_username'; // Your database username
$password = 'your_db_password'; // Your database password
$database = 'your_db_name'; // Your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
