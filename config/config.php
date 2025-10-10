<?php
// ==============================
// Base Config
// ==============================
define('ENVIRONMENT', 'live'); // local | live
define('SITE_NAME', 'Little Black Limo');
define('SITE_URL', 'http://127.0.0.1:8000'); // Local URL
define('LIVE_URL', 'https://a1rides.com.au'); // Live URL

define('LOCAL_API_URL', SITE_URL . '/api/');
define('LIVE_API_URL', LIVE_URL . '/api/');
define('IMG_PATH', '/frontend/asset/img/');
$IMG_URL = LIVE_URL . IMG_PATH;
$API_URL = (ENVIRONMENT === 'local') ? LOCAL_API_URL : LIVE_API_URL;

// ==============================
// API Key / Tokens
// ==============================
define('API_TOKEN', 'nZRapXpITUnir8FrRuPNzyYrz8by9TIlOt5re9taic46rOB0DK6mMTBtV1Jp');

// ==============================
// Helper Function for API Request
// ==============================
function curlGet($endpoint)
{
    global $API_URL;

    $url = rtrim($API_URL, '/') . '/' . ltrim($endpoint, '/');

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json',
            'Authorization: Bearer ' . API_TOKEN
        ],
        CURLOPT_TIMEOUT => 15,
    ]);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) return null;
    return json_decode($response, true);
}

// ==============================
// Fetch Vendor Profile Dynamically
// ==============================
$vendorProfile = curlGet('vendor/profile/details');

if (isset($vendorProfile['success']) && $vendorProfile['success'] && isset($vendorProfile['data'])) {
    $data = $vendorProfile['data'];

    // Contact Info
    define('CONTACT_PHONE', $data['contact_phone'] ?? '0404 359 777');
    define('CONTACT_EMAIL', $data['contact_email'] ?? 'luxury@littleblacklimo.com.au');
    define('CONTACT_US_EMAIL', $data['contact_us_email'] ?? CONTACT_EMAIL);
    define('CONTACT_ADDRESS', $data['address'] ?? 'Wembley WA 6014');

    // Social Links
    define('CONTACT_FACEBOOK', $data['facebook_link'] ?? 'https://www.facebook.com/littleblacklimo');
    define('CONTACT_INSTA', $data['instagram_link'] ?? 'https://www.instagram.com/Little_Limo/#');
    define('CONTACT_TIKTOK', $data['tiktok_link'] ?? 'https://www.tiktok.com/@little.black.limo');
    define('CONTACT_WHATSAPP', $data['whatsapp_link'] ?? 'https://wa.me/61404359777');

    // Custom Keys
    define('BOOKING_DAYS_BEFORE', $data['booking_days_before'] ?? 0);

} else {
    // Fallback Defaults (if API fails)
    define('CONTACT_PHONE', '0404 359 777');
    define('CONTACT_EMAIL', 'luxury@littleblacklimo.com.au');
    define('CONTACT_US_EMAIL', CONTACT_EMAIL);
    define('CONTACT_ADDRESS', 'Wembley WA 6014');

    define('CONTACT_FACEBOOK', 'https://www.facebook.com/littleblacklimo');
    define('CONTACT_INSTA', 'https://www.instagram.com/Little_Limo/#');
    define('CONTACT_TIKTOK', 'https://www.tiktok.com/@little.black.limo');
    define('CONTACT_WHATSAPP', 'https://wa.me/61404359777');

    define('BOOKING_DAYS_BEFORE', 0);
}

// ==============================
// Other Settings
// ==============================
define('TIMEZONE', 'Australia/Sydney');
date_default_timezone_set(TIMEZONE);
define('MAP_KEY', 'AIzaSyDmqyRuikf8RyBrNEYjXKIDghOL6KP54qU');
define('COMPANY_ODBS', '1010295');
define('MAX_PASSENGERS', 7);
