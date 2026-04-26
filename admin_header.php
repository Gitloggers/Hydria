<?php
require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydria Admin | Next-Gen</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #0A2540;
            --primary-glass: rgba(10, 37, 64, 0.95);
            --secondary: #FFB800;
            --secondary-hover: #E6A600;
            --bg: #F1F5F9;
            --surface: #FFFFFF;
            --text: #1E293B;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --shadow-float: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Outfit', sans-serif;
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

        /* Sidebar - Flush Look */
        .sidebar {
            width: 280px;
            background: var(--primary-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-header img { height: 40px; }
        .sidebar-title { font-size: 1.25rem; font-weight: 800; letter-spacing: 1px; color: #fff; }

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
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-weight: 500;
            border-radius: 1rem;
            transition: var(--transition);
            position: relative;
        }

        .nav-link:hover { background-color: rgba(255, 255, 255, 0.05); color: #fff; transform: translateX(5px); }
        .nav-link.active { background-color: rgba(255, 184, 0, 0.1); color: var(--secondary); font-weight: 700; box-shadow: 0 0 20px rgba(255, 184, 0, 0.1); }
        .nav-link.active::before { content: ''; position: absolute; left: 8px; width: 4px; height: 20px; background: var(--secondary); border-radius: 10px; box-shadow: 0 0 10px var(--secondary); }

        /* Mobile Sidebar Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 2000;
            background: var(--secondary);
            color: #000;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
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
                background: rgba(0,0,0,0.5);
                backdrop-filter: blur(4px);
                z-index: 999;
            }
            .sidebar-overlay.active { display: block; }
        }

        /* Utilities */
        .page-header-wrapper { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1.5rem; }
        .page-header h1 { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; color: var(--primary); margin: 0; letter-spacing: -1.5px; }
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .weather-widget { background: #fff; padding: 0.75rem 1.25rem; border-radius: 1rem; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow-float); border: 1px solid var(--border); font-size: 0.8125rem; font-weight: 600; min-width: 240px; }
        .weather-icon { font-size: 1.5rem; color: var(--secondary); }

        /* Tables & Cards */
        .table-card { background: #fff; border-radius: 1.5rem; overflow: hidden; box-shadow: var(--shadow-float); border: 1px solid var(--border); }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #F8FAFC; padding: 1.25rem 1.5rem; text-align: left; font-weight: 800; color: var(--primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }
        td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #F1F5F9; color: var(--text); font-size: 0.9375rem; transition: background 0.3s; }
        tr:hover td { background-color: rgba(255, 184, 0, 0.05); }
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; border-radius: 1rem; font-weight: 700; cursor: pointer; transition: var(--transition); border: none; font-family: inherit; text-decoration: none; }
        .btn-primary { background-color: var(--secondary); color: #fff; }
        .widget-card { background: var(--primary); color: #fff; padding: 2.5rem; border-radius: 2rem; position: relative; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(10, 37, 64, 0.3); transition: var(--transition); }
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
                <img src="assets/logo.png" alt="Logo" style="filter: brightness(0) invert(1);">
                <span class="sidebar-title">HYDRIA</span>
            </div>
            <nav class="sidebar-nav">
                <a href="admin_dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : '' ?>">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
                <a href="admin_projects.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_projects.php' ? 'active' : '' ?>">
                    <i class="fas fa-hammer"></i> Projects
                </a>
                <a href="admin_inquiries.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_inquiries.php' ? 'active' : '' ?>">
                    <i class="fas fa-envelope"></i> Inquiries
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