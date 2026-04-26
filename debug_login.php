<?php
require_once 'db.php';
header('Content-Type: text/plain');

echo "--- HYDRIA CLOUD DEBUGGER ---\n\n";

// 1. Connection Check
echo "1. Connection: SUCCESS (Connected to " . $pdo->query("SELECT DATABASE()")->fetchColumn() . ")\n";

// 2. Environment Check
echo "2. Environment: " . (getenv('APP_ENV') ?: 'Not Set') . "\n";
echo "3. PHP Version: " . phpversion() . "\n";

// 4. User Check
$username = 'admin';
$stmt = $pdo->prepare("SELECT id, username, password_hash FROM admins WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user) {
    echo "4. Admin Found: YES (ID: " . $user['id'] . ")\n";
    
    // 5. Password Verify Check
    $test_pass = 'admin123';
    $is_valid = password_verify($test_pass, $user['password_hash']);
    echo "5. Password Match ('admin123'): " . ($is_valid ? "✅ YES" : "❌ NO") . "\n";
    
    if (!$is_valid) {
        echo "   (Current Hash in DB: " . substr($user['password_hash'], 0, 15) . "...)\n";
        echo "   (New Hash would be: " . substr(password_hash($test_pass, PASSWORD_DEFAULT), 0, 15) . "...)\n";
    }
} else {
    echo "4. Admin Found: ❌ NO (Database is empty or table missing)\n";
}

// 6. Session Check
session_start();
$_SESSION['debug_test'] = 'active';
echo "6. Session Started: " . (isset($_SESSION['debug_test']) ? "✅ YES" : "❌ NO") . "\n";
?>
