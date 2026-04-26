<?php
require_once 'db.php';
try {
    $username = 'admin';
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Clear existing
    $pdo->exec("DELETE FROM admins WHERE username = '$username'");
    
    // Insert new
    $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
    $stmt->execute([$username, $hash]);
    
    echo "✅ Admin user 'admin' has been reset to password 'admin123' on the Aiven Cloud Database.\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
