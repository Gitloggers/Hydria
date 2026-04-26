<?php
// Super Reset for Aiven Cloud
require_once 'db.php';

try {
    $username = 'admin';
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // 1. Clear any existing admin named 'admin'
    $pdo->prepare("DELETE FROM admins WHERE username = ?")->execute([$username]);
    
    // 2. Insert fresh record with precise hash
    $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
    $stmt->execute([$username, $hash]);
    
    echo "✅ SUCCESS: Cloud Admin 'admin' reset to 'admin123'.\n";
    echo "Current DB Context: " . $pdo->query("SELECT DATABASE()")->fetchColumn() . "\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>
