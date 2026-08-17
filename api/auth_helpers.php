<?php
/**
 * Cryptographic helper functions for secure signed cookies
 */

if (session_status() === PHP_SESSION_NONE) {
    $is_secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $is_secure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

function get_app_secret() {
    $secret = getenv('APP_SECRET');
    if (!$secret) {
        // Fallback default for development. In production, APP_SECRET must be configured in .env.
        $secret = 'HYDRIA_SECURE_DEFAULT_SECRET_KEY_CHANGE_ME_IN_PRODUCTION_123!';
    }
    return $secret;
}

function generate_signed_cookie($name, $value, $expiry) {
    $secret = get_app_secret();
    $signature = hash_hmac('sha256', $name . '|' . $value . '|' . $expiry, $secret);
    $cookie_data = json_encode([
        'value' => $value,
        'expiry' => $expiry,
        'signature' => $signature
    ]);
    return base64_encode($cookie_data);
}

function verify_signed_cookie($name, $cookie_base64) {
    if (empty($cookie_base64)) {
        return false;
    }
    $cookie_json = base64_decode($cookie_base64, true);
    if (!$cookie_json) {
        return false;
    }
    $data = json_decode($cookie_json, true);
    if (!isset($data['value']) || !isset($data['expiry']) || !isset($data['signature'])) {
        return false;
    }
    if ($data['expiry'] < time()) {
        return false; // Expired
    }
    $secret = get_app_secret();
    $expected_signature = hash_hmac('sha256', $name . '|' . $data['value'] . '|' . $data['expiry'], $secret);
    if (hash_equals($expected_signature, $data['signature'])) {
        return $data['value'];
    }
    return false;
}
?>
