<?php
require_once 'auth_helpers.php';
$base_path = '';
if (file_exists('modern-ui.css')) {
    $base_path = '';
} else if (file_exists('../modern-ui.css')) {
    $base_path = '../';
}
require_once 'db.php';

// Redirect if already logged in (via session or cookie)
$is_logged_in = false;
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $is_logged_in = true;
} elseif (isset($_COOKIE['admin_session'])) {
    $admin_id = verify_signed_cookie('admin_session', $_COOKIE['admin_session']);
    if ($admin_id !== false) {
        $is_logged_in = true;
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = (int)$admin_id;
    }
}

if ($is_logged_in) {
    header('Location: admin_dashboard.php');
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        try {
            // Precise query using the $pdo variable from db.php
            $stmt = $pdo->prepare("SELECT id, password_hash FROM admins WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                // Success! Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                
                // Set secure HTTP-only cookies for serverless Vercel compatibility
                $is_secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
                $expiry = time() + 86400 * 7; // 7 days
                $cookie_data = generate_signed_cookie('admin_session', $admin['id'], $expiry);
                setcookie('admin_session', $cookie_data, [
                    'expires' => $expiry,
                    'path' => '/',
                    'secure' => $is_secure,
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);

                // Log the successful login
                $logStmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
                $logStmt->execute(["Admin '$username' logged in successfully."]);

                header('Location: admin_dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password.';
            }
        } catch (PDOException $e) {
            $error = 'System error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydria Admin | Secure Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #fbbf24;
            --glass: rgba(255, 255, 255, 0.05);
            --border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #020617;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        /* Hero Background with Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://images.unsplash.com/photo-1541913066827-024214f4882e?auto=format&fit=crop&q=80&w=2000') no-repeat center center/cover;
            opacity: 0.3;
            z-index: -1;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 3rem;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 2rem;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .logo-wrapper {
            margin-bottom: 2.5rem;
        }

        .logo-wrapper img {
            height: 50px;
            filter: brightness(0) invert(1);
            margin-bottom: 1rem;
        }

        .login-title { font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem; }
        .login-subtitle { font-size: 0.875rem; color: rgba(255, 255, 255, 0.6); margin-bottom: 2rem; }

        .form-group { margin-bottom: 1.5rem; text-align: left; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 600; color: rgba(255, 255, 255, 0.8); }

        .form-control {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            color: #fff;
            font-family: inherit;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--secondary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(251, 191, 36, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--secondary);
            color: #000;
            border: none;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: #f59e0b;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(251, 191, 36, 0.4);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.875rem;
            transition: 0.3s;
        }

        .back-link:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-wrapper">
            <img src="<?php echo $base_path; ?>assets/logo.png" alt="Hydria Logo">
            <div class="login-title">Admin Dashboard</div>
            <div class="login-subtitle">Please enter your credentials to continue.</div>
        </div>

        <?php if ($error): ?>
            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <a href="index.php" class="back-link">← Back to Website</a>
    </div>
</body>
</html>