<?php

function curlPost($postData, $endpoint)
{
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $apiBaseUrl = $GLOBALS['API_URL'];
    $APItoken = API_TOKEN;
    $apiUrl = $apiBaseUrl . $endpoint;
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
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FOLLOWLOCATION => true,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // Handle cURL errors
    if ($curlError) {
        return [
            'success' => false,
            'message' => 'Connection Error: ' . $curlError,
            'http_code' => 500
        ];
    }

    // Handle empty responses
    if (empty($response)) {
        return [
            'success' => false,
            'message' => 'Empty response from server',
            'http_code' => $httpCode
        ];
    }

    // Try to decode JSON response
    $apiResponse = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'message' => 'Invalid response format from server',
            'http_code' => $httpCode,
            'raw_response' => $response
        ];
    }

    // Preserve the original API response structure
    $apiResponse['http_code'] = $httpCode;
    return $apiResponse;
}

?>