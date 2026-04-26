<?php
require_once 'db.php';
try {
    $stmt = $pdo->query("SELECT id, username FROM admins");
    $admins = $stmt->fetchAll();
    echo "Found " . count($admins) . " admins:\n";
    foreach ($admins as $a) {
        echo "- " . $a['username'] . " (ID: " . $a['id'] . ")\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
