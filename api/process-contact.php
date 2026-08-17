<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Read JSON payload from fetch
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $csrf_token = $data['csrf_token'] ?? '';
    if (empty($csrf_token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf_token)) {
        echo json_encode(['success' => false, 'message' => 'Invalid request. Please refresh and try again.']);
        exit;
    }

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $service = trim($data['service'] ?? '');
    $message = trim($data['message'] ?? '');

    if (strlen($name) > 100) {
        echo json_encode(['success' => false, 'message' => 'Name must be under 100 characters.']);
        exit;
    }
    if (strlen($email) > 100) {
        echo json_encode(['success' => false, 'message' => 'Email must be under 100 characters.']);
        exit;
    }
    if (strlen($service) > 100) {
        echo json_encode(['success' => false, 'message' => 'Invalid service selected.']);
        exit;
    }
    if (strlen($message) > 2000) {
        echo json_encode(['success' => false, 'message' => 'Message must be under 2000 characters.']);
        exit;
    }

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please fill out all required fields.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address format.']);
        exit;
    }

    // Rate limiting — max 5 submissions per IP per hour
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_file = sys_get_temp_dir() . '/hydria_rate_' . md5($ip);
    $max_requests = 5;
    $window = 3600;

    $requests = [];
    if (file_exists($rate_file)) {
        $raw = @file_get_contents($rate_file);
        if ($raw !== false) {
            $requests = json_decode($raw, true);
            if (!is_array($requests)) $requests = [];
            $requests = array_filter($requests, fn($t) => $t > time() - $window);
        }
    }

    if (count($requests) >= $max_requests) {
        echo json_encode(['success' => false, 'message' => 'Too many submissions. Please try again later.']);
        exit;
    }

    $requests[] = time();
    file_put_contents($rate_file, json_encode(array_values($requests)), LOCK_EX);

    // DNS MX record check — verifies the email domain can actually receive mail
    $domain = substr(strrchr($email, '@'), 1);
    if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
        echo json_encode(['success' => false, 'message' => "The email domain \"$domain\" does not appear to exist. Please double-check your email address."]);
        exit;
    }

    try {
        // Insert into inquiries table
        $sql = "INSERT INTO inquiries (name, email, service, message, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $service, $message]);

        // Log activity
        $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
        $log_stmt->execute(["New Inquiry from: $name"]);

        echo json_encode(['success' => true, 'message' => 'Thank you for your inquiry! We will get back to you soon.']);
    } catch (PDOException $e) {
        // Check if table exists error
        if ($e->getCode() == '42S02') {
            echo json_encode(['success' => false, 'message' => 'System error: Inquiries table not initialized.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error. Please try again later.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>