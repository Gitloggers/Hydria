<?php
require_once 'db.php';

echo "--- Aiven Intelligence Initialization ---\n";
echo "Current DB: " . $pdo->query("SELECT DATABASE()")->fetchColumn() . "\n";

try {
    // 1. Create Tables
    $tables = [
        "admins" => "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "projects" => "CREATE TABLE IF NOT EXISTS projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            category VARCHAR(100),
            image_url VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "inquiries" => "CREATE TABLE IF NOT EXISTS inquiries (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            service VARCHAR(100),
            message TEXT NOT NULL,
            status VARCHAR(20) DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "activity_logs" => "CREATE TABLE IF NOT EXISTS activity_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            action VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",
        "settings" => "CREATE TABLE IF NOT EXISTS settings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            s_key VARCHAR(100) UNIQUE NOT NULL,
            s_value TEXT NOT NULL
        )"
    ];

    foreach ($tables as $name => $sql) {
        echo "Ensuring table '$name' exists... ";
        $pdo->exec($sql);
        echo "✅\n";
    }

    // 2. Initial Admin User
    $checkAdmin = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($checkAdmin == 0) {
        echo "Creating default admin (admin/admin123)... ";
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
        $stmt->execute(['admin', $hash]);
        echo "✅\n";
    }

    // 3. Seeding Settings
    echo "Checking settings... ";
    $checkSettings = $pdo->query("SELECT COUNT(*) FROM settings")->fetchColumn();
    if ($checkSettings == 0) {
        echo "Seeding... ";
        $seeds = [
            'company_email' => 'info@hydriaconstruction.com',
            'company_phone' => '+63 123 456 7890',
            'company_address' => 'Batong Malake, Los Baños, Laguna',
            'footer_desc' => 'Building excellence for over 20 years. Let\'s discuss your next project.'
        ];
        $stmt = $pdo->prepare("INSERT INTO settings (s_key, s_value) VALUES (?, ?)");
        foreach ($seeds as $key => $val) {
            $stmt->execute([$key, $val]);
        }
        echo "✅\n";
    } else {
        echo "Already seeded.\n";
    }

    echo "\n🚀 DATABASE FULLY INITIALIZED FOR CLOUD DEPLOYMENT.\n";

} catch (Exception $e) {
    echo "\n❌ CRITICAL ERROR: " . $e->getMessage() . "\n";
}
?>
