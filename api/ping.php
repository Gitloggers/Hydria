<?php
/**
 * HYDRIA HEARTBEAT (Simplified)
 * This file keeps the Render instance and Aiven database active.
 */

// This file already creates the $pdo connection at the bottom
require_once 'db.php';

header('Content-Type: application/json');

try {
    // Perform a lightweight heartbeat query using the existing $pdo connection
    $stmt = $pdo->query("SELECT 1");
    $db_status = $stmt ? "Active" : "Error";

    echo json_encode([
        "status" => "success",
        "message" => "Hydria is awake",
        "database" => $db_status,
        "timestamp" => date('Y-m-d H:i:s'),
        "env" => (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== 'localhost') ? 'Cloud' : 'Local'
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
