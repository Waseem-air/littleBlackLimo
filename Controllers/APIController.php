<?php

function curlPost($postData,$endpoint){
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $apiBaseUrl = $GLOBALS['API_URL'];
    $APItoken = API_TOKEN;
    $apiUrl = $apiBaseUrl.$endpoint;
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $APItoken
        ],
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false, // Set to true in production
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    // Handle API response
    if ($curlError) {
        http_response_code(500);
        return [
            'success' => false,
            'message' => 'cURL Error: ' . $curlError
        ];
    }
    $apiResponse = json_decode($response, true);

    if ($httpCode === 200 && isset($apiResponse['success']) && $apiResponse['success']) {
        return [
            'success' => true,
            'message' => 'Booking processed successfully',
            'data' => $apiResponse['data'],
        ];
    } else {
        http_response_code($httpCode);
        return [
            'success' => false,
            'message' => $apiResponse['message'] ?? 'API request failed',
            'api_errors' => $apiResponse['errors'] ?? [],
            'http_code' => $httpCode,
            'api_response' => $apiResponse
        ];
    }
}
?>