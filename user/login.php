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

// Handle user login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password (you'll need database functions)
    if (verifyUser($username, $password)) {
        // Prompt the user to enter their PGP key
        echo '<h2>Enter Your PGP Key</h2>';
        echo '<form method="post" action="login.php">';
        echo '<label for="pgp_key">PGP Key:</label>';
        echo '<textarea id="pgp_key" name="pgp_key" rows="5" required></textarea>';
        echo '<button type="submit">Log In</button>';
        echo '</form>';
    } else {
        $loginError = 'Invalid username or password. Please try again.'; // Handle login error
    }
}

// Handle PGP key submission after login form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pgp_key'])) {
    $pgpKey = $_POST['pgp_key'];

    // Verify the PGP key (you'll need PGP-related functions)
    if (verifyPGPKey($username, $pgpKey)) {
        // PGP key is valid, set user session and redirect to dashboard or another page
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); // You can customize the redirection
        exit;
    } else {
        $loginError = 'Invalid PGP key. Please try again or contact support.'; // Handle PGP key verification error
    }
}

// HTML form for user login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <!-- Include your CSS styles here -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>User Login</h1>
    
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Log In</button>
    </form>

    <?php
    if (isset($loginError)) {
        echo '<p class="error">' . $loginError . '</p>';
    }
    ?>

    <p>New user? <a href="register.php">Register here</a></p>
</body>
</html>
