<?php
// --- ENVIRONMENT TOGGLE ---
// Change to 'cloud' to test Aiven, or 'local' for XAMPP coding
$env = 'local';
// --- AUTO DETECTION (For Deployment) ---
if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== '127.0.0.1') {
    $env = 'cloud';
}
if ($env === 'local') {
    // --- LOCAL XAMPP ---
    $host = 'localhost';
    $dbname = 'hydria_db';
    $user = 'root';
    $pass = '';
    $port = '3306';
    $ssl_ca = null;
} else {
    // --- AIVEN CLOUD ---
    $host = 'mysql-19503c8f-hydriaweb.c.aivencloud.com';
    $dbname = 'defaultdb';
    $user = 'avnadmin';
    $pass = 'AVNS_o8-Vhcb-S3jM-FCpdWP';
    $port = '14431';
    $ssl_ca = __DIR__ . '/ca.pem';
}

// 3. Establish Connection
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Add SSL if on Aiven
    if ($ssl_ca) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = $ssl_ca;
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (PDOException $e) {
    // If Aiven fails on local, maybe provide a hint
    $msg = "Connection failed: " . $e->getMessage();
    if ($is_local && !$ssl_ca)
        $msg .= " (Check if XAMPP MySQL is running)";
    die($msg);
}
?>