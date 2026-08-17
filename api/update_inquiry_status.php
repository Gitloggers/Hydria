<?php
require_once 'db.php';
require_once 'check_auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (empty($csrf_token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'CSRF token validation failed.']);
        exit;
    }

    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';

    if ($id > 0 && $status !== '') {
        try {
            // Fetch name for logging
            $stmt_name = $pdo->prepare("SELECT name FROM inquiries WHERE id = ?");
            $stmt_name->execute([$id]);
            $client_name = $stmt_name->fetchColumn();

            // Update status
            $stmt = $pdo->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);

            // Log activity
            $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
            $log_stmt->execute(["Admin contacted client: $client_name"]);

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            error_log('Hydria update_inquiry_status DB error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Database error. Please try again later.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
