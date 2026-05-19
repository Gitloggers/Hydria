<?php
require_once 'db.php';
require_once 'check_auth.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = '';

// Handle Delete Request
if (isset($_POST['delete_id'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }
    
    $id = (int) $_POST['delete_id'];
    try {
        $stmt_title = $pdo->prepare("SELECT title FROM projects WHERE id = ?");
        $stmt_title->execute([$id]);
        $proj_title = $stmt_title->fetchColumn();

        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        
        $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
        $log_stmt->execute(["Deleted Project: $proj_title"]);

        $message = "<div class='alert-modern success'>✅ Project deleted successfully.</div>";
    } catch (PDOException $e) {
        $message = "<div class='alert-modern error'>❌ Error deleting project.</div>";
    }
}

// Handle Add Request
if (isset($_POST['add_project'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    // Check if an external image URL was provided
    $external_url = trim($_POST['image_url_input'] ?? '');
    if (!empty($external_url)) {
        $image_url = $external_url;
    } elseif (!empty($_FILES['image']['name'])) {
        $source_file = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (in_array($ext, $allowed)) {
            $disk_target_dir = dirname(__DIR__) . '/assets/';
            if (!file_exists($disk_target_dir)) {
                mkdir($disk_target_dir, 0777, true);
            }
            $new_filename = uniqid('proj_') . '.' . $ext;
            $target_file = $disk_target_dir . $new_filename;

            if (function_exists('imagecreatetruecolor')) {
                $img_info = getimagesize($source_file);
                if ($img_info !== false) {
                    $width = $img_info[0];
                    $height = $img_info[1];
                    $mime = $img_info['mime'];
                    
                    $max_width = 1200;
                    if ($width > $max_width) {
                        $new_width = $max_width;
                        $new_height = floor($height * ($max_width / $width));
                    } else {
                        $new_width = $width;
                        $new_height = $height;
                    }
                    
                    $image_p = imagecreatetruecolor($new_width, $new_height);
                    if ($ext == 'png' || $ext == 'webp') {
                        imagealphablending($image_p, false);
                        imagesavealpha($image_p, true);
                        $transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);
                        imagefilledrectangle($image_p, 0, 0, $new_width, $new_height, $transparent);
                    }
                    
                    switch($mime) {
                        case 'image/jpeg': $image = imagecreatefromjpeg($source_file); break;
                        case 'image/png': $image = imagecreatefrompng($source_file); break;
                        case 'image/gif': $image = imagecreatefromgif($source_file); break;
                        case 'image/webp': $image = imagecreatefromwebp($source_file); break;
                        default: $image = false;
                    }
                    
                    if ($image !== false) {
                        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        
                        $success = false;
                        switch($mime) {
                            case 'image/jpeg': $success = imagejpeg($image_p, $target_file, 85); break;
                            case 'image/png': $success = imagepng($image_p, $target_file, 8); break;
                            case 'image/gif': $success = imagegif($image_p, $target_file); break;
                            case 'image/webp': $success = imagewebp($image_p, $target_file, 85); break;
                        }
                        imagedestroy($image_p);
                        imagedestroy($image);
                        if ($success) $image_url = 'assets/' . $new_filename;
                    }
                }
            } else {
                // Fallback for environments without GD extension (like Vercel)
                if (move_uploaded_file($source_file, $target_file)) {
                    $image_url = 'assets/' . $new_filename;
                }
            }
        }
    }

    if (!empty($title) && !empty($category)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO projects (title, category, image_url) VALUES (?, ?, ?)");
            $stmt->execute([$title, $category, $image_url]);
            
            $log_stmt = $pdo->prepare("INSERT INTO activity_logs (action) VALUES (?)");
            $log_stmt->execute(["Added New Project: $title"]);

            $message = "<div class='alert-modern success'>🚀 Project uploaded successfully!</div>";
        } catch (PDOException $e) {
            $message = "<div class='alert-modern error'>❌ Database error: " . $e->getMessage() . "</div>";
        }
    }
}

include_once 'admin_header.php';
?>

<style>
    .card-glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        display: block;
        margin-bottom: 0.5rem;
    }
    .form-control-next {
        width: 100%;
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        border: 1px solid var(--border);
        background: #fff;
        font-family: 'Outfit', sans-serif;
        transition: var(--transition);
        box-sizing: border-box;
    }
    .form-control-next:focus {
        outline: none;
        border-color: var(--secondary);
        box-shadow: 0 0 20px rgba(255, 184, 0, 0.2);
        transform: translateY(-2px);
    }
    .btn-magnetic {
        background: var(--secondary);
        color: #fff;
        border: none;
        padding: 1.25rem;
        border-radius: 1rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
    }
    .btn-magnetic:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 30px rgba(255, 184, 0, 0.4);
    }
    .thumb-container {
        width: 60px;
        height: 60px;
        border-radius: 1rem;
        overflow: hidden;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .thumb-zoom {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    tr:hover .thumb-zoom {
        transform: scale(1.2);
    }
    .btn-delete-pill {
        background: transparent;
        color: #EF4444;
        border: 1px solid #FECACA;
        padding: 0.5rem 1.25rem;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }
    .btn-delete-pill:hover {
        background: #EF4444;
        color: #fff;
        border-color: #EF4444;
        transform: scale(1.05);
    }
    .alert-modern {
        padding: 1.25rem;
        border-radius: 1rem;
        margin-bottom: 2rem;
        font-weight: 700;
        font-size: 0.9375rem;
    }
    .alert-modern.success {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }
    .alert-modern.error {
        background: #FEF2F2;
        color: #991B1B;
        border: 1px solid #FEE2E2;
    }
</style>

<div class="page-header-wrapper">
    <div class="page-header">
        <h1>Project Portfolio</h1>
        <p>Curate your architectural gallery for the public website.</p>
    </div>
</div>

<?= $message ?>

<div class="projects-flex-layout" style="display: flex; flex-wrap: wrap; gap: 3rem;">
    <!-- Add Project Form -->
    <div class="card-glass" style="flex: 1; min-width: min(100%, 350px);" data-aos="fade-right">
        <h3 style="margin: 0 0 2rem 0; font-weight: 800; letter-spacing: -0.5px;">Add New Build</h3>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" class="form-control-next" placeholder="e.g. Modern Residential Villa" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control-next" placeholder="e.g. Residential" required>
            </div>

            <div class="form-group">
                <label>Project Image (Upload)</label>
                <input type="file" name="image" class="form-control-next">
                <div style="font-size: 0.7rem; color: #E11D48; font-weight: 700; margin-top: 0.5rem; line-height: 1.2;">
                    ⚠️ Note: File uploads require a writeable disk (Localhost / Render). On Vercel, please use the Image URL input below.
                </div>
            </div>

            <div class="form-group">
                <label>Or Image URL (Required on Vercel)</label>
                <input type="url" name="image_url_input" class="form-control-next" placeholder="https://example.com/image.jpg">
            </div>

            <button type="submit" name="add_project" class="btn-magnetic">Upload to Gallery</button>
        </form>
    </div>

    <!-- Project List -->
    <div class="table-card" style="flex: 2; min-width: min(100%, 500px);" data-aos="fade-left">
        <div class="table-responsive">
            <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Details</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()):
                            ?>
                            <tr>
                                <td style="width: 80px;">
                                    <div class="thumb-container">
                                        <?php if (!empty($row['image_url'])): ?>
                                            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="img" class="thumb-zoom">
                                        <?php else: ?>
                                            <span style="font-size: 0.75rem; color: #94A3B8; font-weight: 800;">NA</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-weight: 800; color: var(--primary); font-size: 1.125rem;"><?= htmlspecialchars($row['title']) ?></div>
                                    <div style="font-size: 0.75rem; color: var(--secondary); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;"><?= htmlspecialchars($row['category']) ?></div>
                                </td>
                                <td style="text-align: right;">
                                    <form method="post" action="" onsubmit="return confirm('Remove this project from the live site?');">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn-delete-pill">Delete Action</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endwhile;
                    } else {
                        echo "<tr><td colspan='3' style='text-align: center; padding: 6rem;'>
                            <div style='font-size: 5rem; margin-bottom: 1.5rem;'>🏗️</div>
                            <div style='font-weight: 800; color: var(--primary); font-size: 1.5rem;'>Empty Portfolio</div>
                            <div style='color: var(--text-muted);'>Time to showcase your next build.</div>
                        </td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='3' style='color: red;'>Database error.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php include_once 'admin_footer.php'; ?>