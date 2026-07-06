<?php
session_start();
session_destroy();

// Clear secure signed session cookie
setcookie('admin_session', '', time() - 3600, '/');

header('Location: index.php');
exit;
?>