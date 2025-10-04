<?php
// Site Config
define('ENVIRONMENT', 'live'); // local | live
define('SITE_NAME', 'Little Black Limo');
define('SITE_URL', 'http://127.0.0.1:8000'); // Local URL
define('LIVE_URL', 'https://a1rides.com.au'); // Live URL

// API Config
define('LOCAL_API_URL', SITE_URL . '/api/');   // Local API URL
define('LIVE_API_URL', LIVE_URL . '/api/');    // Live API URL
define('IMG_PATH', '/frontend/asset/img/');

$IMG_URL = LIVE_URL.IMG_PATH;
$API_URL = (ENVIRONMENT === 'local') ? LOCAL_API_URL : LIVE_API_URL;

// ==============================
// Google Maps / API Keys
// ==============================
define('MAP_KEY', 'AIzaSyDmqyRuikf8RyBrNEYjXKIDghOL6KP54qU');

// ==============================
// Booking / App Settings
// ==============================
define('MAX_PASSENGERS', 7);
define('API_TOKEN', 'nZRapXpITUnir8FrRuPNzyYrz8by9TIlOt5re9taic46rOB0DK6mMTBtV1Jp');
// ==============================
// Other Settings
// ==============================
define('TIMEZONE', 'Australia/Sydney');
date_default_timezone_set(TIMEZONE);

// ==============================
// Contact Information
// ==============================
define('CONTACT_PHONE',   '0404 359 777');
define('CONTACT_EMAIL',   'luxury@littleblacklimo.com.au');
define('CONTACT_US_EMAIL',   'luxury@littleblacklimo.com.au');
$CONTACT_US_EMAIL = CONTACT_US_EMAIL;
define('CONTACT_ADDRESS', 'Wembley WA 6014');
// config/config.php
define('COMPANY_ODBS', '1010295');


// ==============================
// Social Link
// ==============================
define('CONTACT_FACEBOOK', 'https://www.facebook.com/littleblacklimo');
define('CONTACT_INSTA', 'https://www.instagram.com/Little_Limo/#');
define('CONTACT_TIKTOK', 'https://www.tiktok.com/@little.black.limo');
define('CONTACT_WHATSAPP', 'https://wa.me/61404359777');


