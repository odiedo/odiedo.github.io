<?php
$consumerKey = 'C0bFzcfD4Vu9Q6GtoTASlBcgUG89qPMIJdGqaswJb0JRbAJi'; 
$consumerSecret = 'S8kTharJ6TM94AcSW5i8VPi9MNN7vqDT5O3t1uK0EB0tsp6tKhVZXP9t04VCQPUr'; 

// Base64 encode the consumer key and secret
$credentials = base64_encode($consumerKey . ':' . $consumerSecret);

// Set up the request headers
$headers = [
    'Authorization: Basic ' . $credentials,
    'Content-Type: application/json'
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if ($response === FALSE) {
    die('Error: ' . curl_error($ch));
}

// Close cURL
curl_close($ch);

// Decode the response
$result = json_decode($response);

// Check if access token is available
if (isset($result->access_token)) {
    $accessToken = $result->access_token;
    echo $accessToken;
} else {
    echo 'Error: Unable to retrieve access token';
    if (isset($result->error)) {
        echo ' - ' . $result->error;
    }
    if (isset($result->error_description)) {
        echo ': ' . $result->error_description;
    }
}
?>