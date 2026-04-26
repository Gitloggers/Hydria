<?php
require_once 'db.php';
try {
    $db = $pdo->query("SELECT DATABASE()")->fetchColumn();
    echo "Connected to Database: " . $db . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
