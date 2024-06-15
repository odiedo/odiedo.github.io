<?php
// Include the accessToken.php script to get the access token
$accessToken = trim(shell_exec('php accessToken.php'));

// Check if we have an access token
if (!$accessToken) {
    die('Error: Unable to retrieve access token');
}

// Prepare the STK push request
$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$headers = [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json'
];

$data = [
    'BusinessShortCode' => 174379,
    'Password' => base64_encode('174379' . 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919' . '20240615101907'),
    'Timestamp' => '20240615101907',
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => 1,
    'PartyA' => 254743050069,
    'PartyB' => 174379,
    'PhoneNumber' => 254743050069,
    'CallBackURL' => '', // Leave it empty for now
    'AccountReference' => 'CompanyXLTD',
    'TransactionDesc' => 'Payment of X'
];

// Initialize cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if ($response === FALSE) {
    die('Error: ' . curl_error($ch));
}

// Close cURL
curl_close($ch);

// Output the response
echo $response;
?>
