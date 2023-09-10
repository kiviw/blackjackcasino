// Get references to DOM elements
const subaddressElement = document.getElementById('subaddress');
const balanceElement = document.getElementById('balance');
const gamesHistoryList = document.getElementById('games-history');
const transactionHistoryList = document.getElementById('transaction-history');
const copySubaddressButton = document.getElementById('copySubaddress');
const withdrawalForm = document.getElementById('withdrawalForm');

// Event listener for copying subaddress
copySubaddressButton.addEventListener('click', () => {
    // Implement logic to copy the subaddress to the clipboard
    // For example, you can use the Clipboard API
    // Replace 'Your Subaddress Here' with the actual subaddress
    const subaddress = subaddressElement.textContent;
    copyToClipboard(subaddress);
    alert('Subaddress copied to clipboard!');
});

// Event listener for withdrawal form submission
withdrawalForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Get the withdrawal amount from the form
    const withdrawalAmount = parseFloat(document.getElementById('withdrawAmount').value);
    
    // Implement logic to process the withdrawal request
    // Verify if withdrawal amount is valid and less than or equal to the balance
    // Update the balance and transaction history accordingly
    // Display success or error messages
});

// Function to copy text to the clipboard
function copyToClipboard(text) {
    const tempInput = document.createElement('input');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
}

// Example: Fetch and update data from the server (replace with your backend logic)
function updateDashboardData() {
    // Replace these with actual data fetched from your server
    const subaddress = 'Your Subaddress Here';
    const balance = '$0.00';
    const gamesHistory = ['Game 1: Win', 'Game 2: Loss'];
    const transactionHistory = ['Deposit: $100.00', 'Withdrawal: $50.00'];

    // Update the dashboard elements with the retrieved data
    subaddressElement.textContent = subaddress;
    balanceElement.textContent = balance;

    // Clear and repopulate the games history list
    gamesHistoryList.innerHTML = '';
    gamesHistory.forEach((item) => {
        const listItem = document.createElement('li');
        listItem.textContent = item;
        gamesHistoryList.appendChild(listItem);
    });

    // Clear and repopulate the transaction history list
    transactionHistoryList.innerHTML = '';
    transactionHistory.forEach((item) => {
        const listItem = document.createElement('li');
        listItem.textContent = item;
        transactionHistoryList.appendChild(listItem);
    });
}

// Call the function to initially populate the dashboard
updateDashboardData();
      
