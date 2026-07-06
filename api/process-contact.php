<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read JSON payload from fetch
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $service = trim($data['service'] ?? '');
    $message = trim($data['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please fill out all required fields.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address format.']);
        exit;
    }

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