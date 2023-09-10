<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <!-- Include your CSS styles here -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>User Dashboard</h1>
    
    <!-- Display Wallet Subaddress -->
    <p>Wallet Subaddress: <span id="subaddress">Your Subaddress Here</span></p>
    
    <!-- Display Account Balance -->
    <p>Account Balance: <span id="balance">$0.00</span></p>
    
    <!-- Games History -->
    <h2>Games History</h2>
    <ul id="games-history">
        <li>Game 1: Win</li>
        <li>Game 2: Loss</li>
        <!-- Add more game history items dynamically -->
    </ul>
    
    <!-- Transaction History -->
    <h2>Transaction History</h2>
    <ul id="transaction-history">
        <li>Deposit: $100.00</li>
        <li>Withdrawal: $50.00</li>
        <!-- Add more transaction history items dynamically -->
    </ul>
    
    <!-- Copy Subaddresses -->
    <button id="copySubaddress">Copy Wallet Subaddress</button>
    
    <!-- Withdrawal Form -->
    <h2>Withdraw Funds</h2>
    <form id="withdrawalForm">
        <label for="withdrawAmount">Withdraw Amount:</label>
        <input type="number" id="withdrawAmount" min="1" max="1000" step="0.01" required>
        <button type="submit">Withdraw</button>
    </form>
    
    <!-- Logout Button -->
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
    
    <!-- Link to Live Games Menu -->
    <a href="live_games.php">Live Games Menu</a>
    
    <!-- Include your JavaScript for user interactions here -->
    <script src="js/dashboard.js"></script>
</body>
</html>
