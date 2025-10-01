<?php
// Site Config
define('ENVIRONMENT', 'local'); // local | live
define('SITE_NAME', 'Little Black Limo');
define('SITE_URL', 'http://localhost:8000'); // Local URL
define('LIVE_URL', 'https://develop.a1rides.com.au.com'); // Live URL

// API Config
define('LOCAL_API_URL', SITE_URL . '/api/');   // Local API URL
define('LIVE_API_URL', LIVE_URL . '/api/');    // Live API URL

$API_URL = (ENVIRONMENT === 'local') ? LOCAL_API_URL : LIVE_API_URL;

// ==============================
// Google Maps / API Keys
// ==============================
define('MAP_KEY', 'AIzaSyDmqyRuikf8RyBrNEYjXKIDghOL6KP54qU');

// ==============================
// Booking / App Settings
// ==============================
define('MAX_PASSENGERS', 7);
define('VENDOR_ID', 840);

// ==============================
// Contact Info
// ==============================
define('CONTACT_PHONE', '0404 359 777');
define('CONTACT_EMAIL', 'info@littleblacklimo.com');

// ==============================
// Other Settings
// ==============================
define('TIMEZONE', 'Australia/Sydney');
date_default_timezone_set(TIMEZONE);
