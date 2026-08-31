<?php
require_once 'check_auth.php';
$base_path = '';
if (file_exists('modern-ui.css')) {
    $base_path = '';
} else if (file_exists('../modern-ui.css')) {
    $base_path = '../';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydria Admin | Next-Gen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #0A3D7C;
            --primary-glass: rgba(10, 61, 124, 0.98);
            --secondary: #F15A24;
            --secondary-hover: #D84A19;
            --bg: #F8FAFC;
            --surface: #FFFFFF;
            --text: #1E293B;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --shadow-float: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* Sidebar - Professional Navy Look */
        .sidebar {
            width: 280px;
            background: var(--primary);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-header img { 
            height: 40px; 
            background: white;
            padding: 5px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .sidebar-title { 
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.75rem; 
            font-weight: 400; 
            letter-spacing: 2px; 
            color: var(--secondary); 
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-weight: 600;
            border-radius: 1rem;
            transition: var(--transition);
            position: relative;
            font-size: 0.9rem;
        }

        .nav-link:hover { background-color: rgba(241, 90, 36, 0.12); color: var(--secondary); transform: translateX(5px); }
        .nav-link.active { background-color: var(--secondary); color: #FFFFFF; font-weight: 800; box-shadow: 0 10px 15px -3px rgba(241, 90, 36, 0.35); }
        
        /* Mobile Sidebar Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 2000;
            background: var(--secondary);
            color: #fff;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(201, 168, 76, 0.3);
            transition: var(--transition);
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: clamp(1.5rem, 5vw, 4rem);
            box-sizing: border-box;
            width: calc(100% - 280px);
            transition: var(--transition);
            min-height: 100vh;
        }

        /* Mobile Breakpoints */
        @media (max-width: 992px) {
            .sidebar {
                left: -280px;
                border-radius: 0;
            }
            .sidebar.active { left: 0; }
            .sidebar-toggle { display: flex; align-items: center; justify-content: center; }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 6rem 20px 2rem 20px; /* 20px Mobile Padding */
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(13, 27, 75, 0.5);
                backdrop-filter: blur(4px);
                z-index: 999;
            }
            .sidebar-overlay.active { display: block; }
        }

        /* Utilities */
        .page-header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1.5rem; }
        .page-header h1 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 400; color: var(--primary); margin: 0; letter-spacing: 1px; }
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        
        /* Tables & Cards */
        .table-card { background: #fff; border-radius: 1.5rem; overflow: hidden; box-shadow: var(--shadow-float); border: 1px solid var(--border); }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #F8FAFC; padding: 1.25rem 1.5rem; text-align: left; font-weight: 800; color: var(--primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }
        td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #F1F5F9; color: var(--text); font-size: 0.9375rem; transition: background 0.3s; }
        tr:hover td { background-color: rgba(201, 168, 76, 0.05); }
        .widget-card { background: var(--primary); color: #fff; padding: 2.5rem; border-radius: 2rem; position: relative; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(13, 27, 75, 0.3); transition: var(--transition); }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2.5rem;
        }

        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="<?php echo $base_path; ?>assets/logo.png" alt="Logo">
                <span class="sidebar-title">HYDRIA</span>
            </div>
            <nav class="sidebar-nav">
                <a href="admin_dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
                <a href="admin_projects.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_projects.php' ? 'active' : '' ?>">
                    <i class="fas fa-hammer"></i> Projects
                </a>
                <a href="admin_settings.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_settings.php' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </nav>
            <div style="padding: 1rem;">
                <a href="logout.php" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; color: #F87171; text-decoration: none; font-weight: 700; border-radius: 1rem; transition: 0.3s;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </aside>

        <script>
            function toggleSidebar() {
                document.querySelector('.sidebar').classList.toggle('active');
                document.querySelector('.sidebar-overlay').classList.toggle('active');
                const icon = document.querySelector('.sidebar-toggle i');
                if (document.querySelector('.sidebar').classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        </script>
        <main class="main-content">