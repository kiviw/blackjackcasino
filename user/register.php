<?php
session_start();

// Include the necessary database files and functions
include('../database_config/db_connection.php');
include('../database_config/db_queries.php');

// Check if the user is already logged in, if yes, redirect to the dashboard or another page
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php'); // You can customize the redirection
    exit;
}

// Handle user registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password (you'll need database functions)
    if (verifyUser($username, $password)) {
        // Generate a one-time PGP key for the user
        $pgpKey = generatePGPKey(); // You need to implement this function

        // Store the PGP key for the user (you'll need database functions)
        if (storePGPKey($username, $pgpKey)) {
            // Prompt the user to save their PGP key
            echo '<h2>Your Registration is Successful!</h2>';
            echo '<p>Your PGP Key:</p>';
            echo '<textarea rows="5" readonly>' . $pgpKey . '</textarea>';
            echo '<p>Please save this PGP key for future logins. Click <a href="login.php">here</a> to log in.</p>';
        } else {
            $registrationError = 'Registration failed. Please try again or contact support.'; // Handle registration error
        }
    } else {
        $registrationError = 'Invalid username or password. Please try again.'; // Handle registration error
    }
}

// HTML form for user registration
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <!-- Include your CSS styles here -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>User Registration</h1>
    
    <form method="post" action="register.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Register</button>
    </form>

    <?php
    if (isset($registrationError)) {
        echo '<p class="error">' . $registrationError . '</p>';
    }
    ?>

    <p>Already registered? <a href="login.php">Log in here</a></p>
</body>
</html>
