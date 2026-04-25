<?php
require_once 'db.php';
require_once 'check_auth.php';

$message = '';
$error = '';

// Handle Settings Update
if (isset($_POST['update_settings'])) {
    try {
        $pdo->beginTransaction();
        foreach ($_POST['settings'] as $key => $value) {
            $stmt = $pdo->prepare("UPDATE settings SET s_value = ? WHERE s_key = ?");
            $stmt->execute([trim($value), $key]);
        }
        $pdo->commit();
        
        $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
        $log_stmt->execute(["Admin updated System Settings"]);
        
        $message = "Settings updated successfully.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Failed to update settings: " . $e->getMessage();
    }
}

// Handle Password Change
if (isset($_POST['change_password'])) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new !== $confirm) {
        $error = "New passwords do not match.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT password_hash FROM admins WHERE id = ?");
            $stmt->execute([$_SESSION['admin_id']]);
            $hash = $stmt->fetchColumn();

            if (password_verify($current, $hash)) {
                $new_hash = password_hash($new, PASSWORD_DEFAULT);
                $upd = $pdo->prepare("UPDATE admins SET password_hash = ? WHERE id = ?");
                $upd->execute([$new_hash, $_SESSION['admin_id']]);
                
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
                $log_stmt->execute(["Admin changed account password"]);
                
                $message = "Password changed successfully.";
            } else {
                $error = "Current password incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

// Fetch Settings
$settings = [];
try {
    $stmt = $pdo->query("SELECT s_key, s_value FROM settings");
    while ($row = $stmt->fetch()) {
        $settings[$row['s_key']] = $row['s_value'];
    }
} catch (PDOException $e) {}

include_once 'admin_header.php';
?>

<div class="page-header-wrapper" data-aos="fade-down">
    <div class="page-header">
        <h1>System Settings</h1>
        <p>Configure company info and security preferences.</p>
    </div>
</div>

<?php if ($message): ?>
    <div style="background: #ECFDF5; color: #065F46; padding: 1.25rem; border-radius: 1rem; margin-bottom: 2rem; font-weight: 700; border: 1px solid #A7F3D0;">
        ✅ <?= $message ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div style="background: #FEF2F2; color: #991B1B; padding: 1.25rem; border-radius: 1rem; margin-bottom: 2rem; font-weight: 700; border: 1px solid #FEE2E2;">
        ❌ <?= $error ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 3rem;">
    <!-- Company Info & System Prefs -->
    <div style="display: flex; flex-direction: column; gap: 3rem;">
        <div class="widget-card" style="background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); color: var(--primary); border: 1px solid var(--border);" data-aos="fade-up">
            <h3 style="margin-top: 0; font-weight: 800; letter-spacing: -0.5px;">🏢 Company Information</h3>
            <form method="post" action="">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem;">
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem;">Public Email</label>
                        <input type="email" name="settings[company_email]" value="<?= htmlspecialchars($settings['company_email'] ?? '') ?>" 
                               style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid var(--border); font-family: inherit;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem;">Contact Phone</label>
                        <input type="text" name="settings[company_phone]" value="<?= htmlspecialchars($settings['company_phone'] ?? '') ?>" 
                               style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid var(--border); font-family: inherit;">
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem;">Office Address</label>
                    <input type="text" name="settings[company_address]" value="<?= htmlspecialchars($settings['company_address'] ?? '') ?>" 
                           style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid var(--border); font-family: inherit;">
                </div>
                <div style="margin-top: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem;">Footer Description</label>
                    <textarea name="settings[footer_desc]" rows="3" style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid var(--border); font-family: inherit; resize: none;"><?= htmlspecialchars($settings['footer_desc'] ?? '') ?></textarea>
                </div>
                <button type="submit" name="update_settings" class="btn btn-primary" style="margin-top: 2rem; width: 100%; font-weight: 800;">Save System Preferences</button>
            </form>
        </div>
    </div>

    <!-- Security Section -->
    <div class="widget-card" style="background: var(--primary); color: #fff; height: fit-content;" data-aos="fade-left">
        <h3 style="margin-top: 0; font-weight: 800; letter-spacing: -0.5px; color: var(--secondary);">🔒 Security Access</h3>
        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.6); margin-bottom: 2.5rem;">Update your administrative credentials.</p>
        
        <form method="post" action="">
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 0.5rem;">Current Password</label>
                <input type="password" name="current_password" required 
                       style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff; font-family: inherit;">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 0.5rem;">New Password</label>
                <input type="password" name="new_password" required 
                       style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff; font-family: inherit;">
            </div>
            <div style="margin-bottom: 2.5rem;">
                <label style="display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: rgba(255,255,255,0.4); margin-bottom: 0.5rem;">Confirm New Password</label>
                <input type="password" name="confirm_password" required 
                       style="width: 100%; padding: 0.875rem; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); color: #fff; font-family: inherit;">
            </div>
            <button type="submit" name="change_password" class="btn btn-primary" style="width: 100%; font-weight: 800;">Update Password</button>
        </form>
    </div>
</div>

<?php include_once 'admin_footer.php'; ?>
