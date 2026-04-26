<?php
// --- ENVIRONMENT TOGGLE ---
$env = 'host';

// --- AUTO DETECTION ---
if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== '127.0.0.1') {
    $env = 'cloud';
}

// Load Secure Credentials
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

if ($env === 'local') {
    $host = 'localhost';
    $dbname = 'hydria_db';
    $user = 'root';
    $pass = '';
    $port = '3306';
    $ssl_ca = null;
} else {
    // Aiven Cloud
    $host = 'mysql-19503c8f-hydriaweb.c.aivencloud.com';
    $dbname = 'defaultdb';
    $user = 'avnadmin';
    // Use the password from config.php, or fallback to env variable
    $pass = defined('AIVEN_PASS') ? AIVEN_PASS : getenv('AIVEN_PASS');
    $port = '14431';
    $ssl_ca = __DIR__ . '/ca.pem';
}

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    if ($ssl_ca) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = $ssl_ca;
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    die("Database Connection Error. Please verify your credentials.");
}
?>