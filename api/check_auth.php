<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = false;

// 1. Check native session first (works locally/same container)
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $is_logged_in = true;
} 
// 2. Fallback to secure HTTP-only cookie (works on serverless Vercel)
elseif (isset($_COOKIE['admin_logged_in']) && $_COOKIE['admin_logged_in'] === 'true') {
    $is_logged_in = true;
    $_SESSION['admin_logged_in'] = true;
    if (isset($_COOKIE['admin_id'])) {
        $_SESSION['admin_id'] = $_COOKIE['admin_id'];
    }
}

if (!$is_logged_in) {
    header('Location: login.php');
    exit;
}
?>