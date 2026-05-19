<?php
session_start();
session_destroy();

// Clear Vercel session cookies
setcookie('admin_logged_in', '', time() - 3600, '/');
setcookie('admin_id', '', time() - 3600, '/');

header('Location: index.php');
exit;
?>