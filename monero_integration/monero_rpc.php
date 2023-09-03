<?php
// monero_rpc.php

class Monero_Rpc
{
    private $apiUrl = 'https://xmr.getblock.io/45dd08d7-a9d2-479d-a2e4-0a4652a570d4/mainnet/json_rpc';
    private $apiKey = '45dd08d7-a9d2-479d-a2e4-0a4652a570d4';

    public function createSubaddress($user_id)
    {
        // Generate a subaddress for the user
        $params = array(
            'jsonrpc' => '2.0',
            'id' => 'create_subaddress',
            'method' => 'create_address',
            'params' => array(
                'account_index' => $user_id, // Use user ID as an account index
            ),
        );

        $response = $this->sendRequest($params);

        if (isset($response['result']['address'])) {
            return $response['result']['address'];
        }

        return null;
    }

    public function checkDeposits($user_address)
    {
        // Check deposit history for a specific user address
        $params = array(
            'jsonrpc' => '2.0',
            'id' => 'check_deposits',
            'method' => 'get_payments',
            'params' => array(
                'payment_id' => $user_address, // Use user's address as payment_id
            ),
        );

        $response = $this->sendRequest($params);

        if (isset($response['result']['payments'])) {
            return $response['result']['payments'];
        }

        return null;
    }

    private function sendRequest($params)
    {
        $headers = array(
            'Content-Type: application/json',
            'x-api-key: ' . $this->apiKey,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
?>
