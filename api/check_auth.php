<?php
require_once 'auth_helpers.php';

$is_logged_in = false;

// 1. Check native session first (works locally/same container)
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
    $is_logged_in = true;
} 
// 2. Fallback to secure signed HTTP-only cookie (works on serverless Vercel)
elseif (isset($_COOKIE['admin_session'])) {
    $admin_id = verify_signed_cookie('admin_session', $_COOKIE['admin_session']);
    if ($admin_id !== false) {
        $is_logged_in = true;
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = (int)$admin_id;
    }
}

if (!$is_logged_in) {
    header('Location: login.php');
    exit;
}
?>