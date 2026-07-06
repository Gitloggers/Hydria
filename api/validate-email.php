<?php
header('Content-Type: application/json');

$email = trim($_GET['email'] ?? '');

if (empty($email)) {
    echo json_encode(['valid' => false, 'message' => 'Email is empty.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['valid' => false, 'message' => 'Please enter a valid email address format.']);
    exit;
}

$domain = substr(strrchr($email, '@'), 1);
if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
    echo json_encode(['valid' => false, 'message' => "The email domain \"$domain\" does not appear to exist."]);
    exit;
}

echo json_encode(['valid' => true]);
