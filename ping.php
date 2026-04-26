<?php
/**
 * HYDRIA HEARTBEAT
 * This file keeps the Render instance and Aiven database active.
 * Point UptimeRobot to: https://your-app-url.onrender.com/ping.php
 */

require_once 'db.php';

header('Content-Type: application/json');

try {
    // Get DB Instance
    $db = Database::getInstance();
    $pdo = $db->getConnection();
    
    // Perform a lightweight heartbeat query to keep Aiven awake
    $stmt = $pdo->query("SELECT 1");
    $db_status = $stmt ? "Active" : "Error";

    echo json_encode([
        "status" => "success",
        "message" => "Hydria is awake",
        "database" => $db_status,
        "timestamp" => date('Y-m-d H:i:s'),
        "env" => (getenv('APP_ENV') === 'production') ? 'Cloud' : 'Local'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Heartbeat failed",
        "error" => $e->getMessage()
    ]);
}
?>
