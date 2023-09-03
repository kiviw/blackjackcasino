<?php
// check_deposits.php

require 'monero_config.php';
require 'monero_rpc.php';

$user_id = 1; // Replace with the user's ID

// Initialize the Monero RPC class
$moneroRpc = new Monero_Rpc();

// Create a subaddress for the user
$subaddress = $moneroRpc->createSubaddress($user_id);

if ($subaddress !== null) {
    echo "Subaddress for User ID $user_id: $subaddress\n";

    // Check deposit history for the user's subaddress
    $deposits = $moneroRpc->checkDeposits($subaddress);

    if ($deposits !== null) {
        echo "Deposit history for User ID $user_id:\n";
        foreach ($deposits as $deposit) {
            echo "Tx Hash: " . $deposit['tx_hash'] . ", Amount: " . $deposit['amount'] / 1e12 . " XMR\n";
        }
    } else {
        echo "No deposit history found for User ID $user_id\n";
    }
} else {
    echo "Failed to create a subaddress for User ID $user_id\n";
}
?>
