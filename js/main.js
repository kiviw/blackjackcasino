// Define a deck of cards
const deck = [
    { value: '2', suit: 'hearts' },
    { value: '3', suit: 'hearts' },
    // ... (add all cards in the deck)
    { value: 'A', suit: 'spades' }
];

// Define variables for player's balance, current bet, and hands
let playerBalance = 10.00; // Initial balance in XMR
let currentBet = 0.01;    // Initial bet amount in XMR
let playerHand = [];
let dealerHand = [];

// Function to create a card image URL based on card value and suit
function getCardImageURL(value, suit) {
    return `images/cards/${value}_of_${suit}.png`;
}

// Function to display cards with images
function displayCards(container, cards) {
    container.innerHTML = '';
    cards.forEach(card => {
        const cardImage = document.createElement('img');
        cardImage.src = getCardImageURL(card.value, card.suit);
        container.appendChild(cardImage);
    });
}

// Function to calculate the value of a hand
function calculateHandValue(hand) {
    let value = 0;
    let numAces = 0;

    for (const card of hand) {
        switch (card.value) {
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                value += parseInt(card.value);
                break;
            case '10':
            case 'J':
            case 'Q':
            case 'K':
                value += 10;
                break;
            case 'A':
                value += 11;
                numAces++;
                break;
        }
    }

    // Handle aces if needed
    while (value > 21 && numAces > 0) {
        value -= 10;
        numAces--;
    }

    return value;
}

// Function to update the player's balance display
function updateBalanceDisplay() {
    const playerBalanceElement = document.getElementById('playerBalance');
    playerBalanceElement.textContent = `${playerBalance.toFixed(2)} XMR`;
}

// Function to update the game result message
function updateGameMessage(message) {
    const gameMessage = document.getElementById('gameMessage');
    gameMessage.textContent = message;
}

// Function to handle placing a bet
function placeBet() {
    const betAmountInput = document.getElementById('betAmount');
    const betAmount = parseFloat(betAmountInput.value);

    if (betAmount >= 0.01 && betAmount <= 1000 && betAmount <= playerBalance) {
        // Update the current bet and player's balance
        currentBet = betAmount;
        playerBalance -= currentBet;

        // Update the balance display
        updateBalanceDisplay();

        // Deal initial cards and update the display
        playerHand = [];
        dealerHand = [];

        dealCard(playerHand);
        dealCard(playerHand);
        dealCard(dealerHand);
        dealCard(dealerHand);

        displayCards(document.getElementById('playerCards'), playerHand);
        displayCards(document.getElementById('dealerCards'), dealerHand);

        // Enable Hit and Stand buttons
        const hitButton = document.getElementById('hitButton');
        const standButton = document.getElementById('standButton');
        hitButton.removeAttribute('disabled');
        standButton.removeAttribute('disabled');

        // Check for blackjack
        if (calculateHandValue(playerHand) === 21) {
            playerWins();
        } else if (calculateHandValue(dealerHand) === 21) {
            dealerWins();
        } else {
            updateGameMessage("Player's turn. Choose Hit or Stand.");
        }
    } else {
        // Handle invalid bet amount
        alert('Invalid bet amount. Bet must be between 0.01 and 1000 XMR.');
    }
}

// Function to deal a card from the deck
function dealCard(hand) {
    const randomCardIndex = Math.floor(Math.random() * deck.length);
    const cardDrawn = deck.splice(randomCardIndex, 1)[0];
    hand.push(cardDrawn);
}

// Function to handle player's Hit action
function hit() {
    dealCard(playerHand);
    displayCards(document.getElementById('playerCards'), playerHand);

    const playerValue = calculateHandValue(playerHand);
    if (playerValue > 21) {
        playerBusts();
    } else if (playerValue === 21) {
        playerWins();
    }
}

// Function to handle player's Stand action
function stand() {
    // Dealer's turn
    let dealerValue = calculateHandValue(dealerHand);

    while (dealerValue < 17) {
        dealCard(dealerHand);
        dealerValue = calculateHandValue(dealerHand);
    }

    displayCards(document.getElementById('dealerCards'), dealerHand);

    if (dealerValue > 21 || dealerValue < calculateHandValue(playerHand)) {
        playerWins();
    } else if (dealerValue > calculateHandValue(playerHand)) {
        dealerWins();
    } else {
        updateGameMessage('It\'s a push! Bet refunded.');
        playerBalance += currentBet;
        updateBalanceDisplay();
    }
}

// Function to handle a player win
function playerWins() {
    updateGameMessage('Player wins! You won ' + (currentBet * 2).toFixed(2) + ' XMR.');
    playerBalance += currentBet * 2;
    updateBalanceDisplay();
}

// Function to handle a dealer win
function dealerWins() {
    updateGameMessage('Dealer wins. You lost ' + currentBet.toFixed(2) + ' XMR.');
    // Nothing to add to playerBalance since it was already subtracted when placing the bet
    updateBalanceDisplay();
}

// Function to handle a player bust
function playerBusts() {
    updateGameMessage('Player busts. You lost ' + currentBet.toFixed(2) + ' XMR.');
    // Nothing to add to playerBalance since it was already subtracted when placing the bet
    updateBalanceDisplay();
}

// Add event listeners for buttons
document.addEventListener('DOMContentLoaded', function () {
    const placeBetButton = document.getElementById('placeBet');
    const hitButton = document.getElementById('hitButton');
    const standButton = document.getElementById('standButton');

    placeBetButton.addEventListener('click', placeBet);
    hitButton.addEventListener('click', hit);
    standButton.addEventListener('click', stand);
});
      
