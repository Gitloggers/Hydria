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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #0A2540;
            --primary-glass: rgba(10, 37, 64, 0.8);
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
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Glassmorphism */
        .sidebar {
            width: 280px;
            background: var(--primary-glass);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header {
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-header img {
            height: 40px;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: #fff;
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
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-weight: 500;
            border-radius: 1rem;
            transition: var(--transition);
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fff;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: rgba(255, 184, 0, 0.1);
            color: var(--secondary);
            font-weight: 700;
            box-shadow: 0 0 20px rgba(255, 184, 0, 0.1);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 8px;
            width: 4px;
            height: 20px;
            background: var(--secondary);
            border-radius: 10px;
            box-shadow: 0 0 10px var(--secondary);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 3rem;
            box-sizing: border-box;
        }

        .page-header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin: 0;
            letter-spacing: -1px;
        }

        /* Weather Stub */
        .weather-widget {
            background: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-float);
            border: 1px solid var(--border);
            font-size: 0.875rem;
            font-weight: 600;
        }

        .weather-icon {
            font-size: 1.5rem;
            color: var(--secondary);
        }

        /* Modern Table UI */
        .table-card {
            background: #fff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: var(--shadow-float);
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #F8FAFC;
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 800;
            color: var(--primary);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #F1F5F9;
            color: var(--text);
            font-size: 0.9375rem;
            transition: background 0.3s;
        }

        tr:hover td {
            background-color: rgba(255, 184, 0, 0.05);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: inherit;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--secondary);
            color: #fff;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(255, 184, 0, 0.3);
        }

        /* Widget Cards */
        .widget-card {
            background: var(--primary);
            color: #fff;
            padding: 2.5rem;
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(10, 37, 64, 0.3);
            transition: var(--transition);
        }

        .widget-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 35px 60px -12px rgba(10, 37, 64, 0.4);
        }

        .widget-label {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 1rem;
        }

        .widget-value {
            font-size: 4rem;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
        }

        .widget-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 6rem;
            opacity: 0.1;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="assets/logo.png" alt="Logo" style="filter: brightness(0) invert(1);">
            <span class="sidebar-title">HYDRIA</span>
        </div>
        <nav class="sidebar-nav">
            <a href="admin_dashboard.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : '' ?>">
                <span>📊</span> Dashboard
            </a>
            <a href="admin_projects.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_projects.php' ? 'active' : '' ?>">
                <span>🏗️</span> Projects
            </a>
            <a href="admin_inquiries.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_inquiries.php' ? 'active' : '' ?>">
                <span>✉️</span> Inquiries
            </a>
            <a href="admin_settings.php"
                class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin_settings.php' ? 'active' : '' ?>">
                <span>⚙️</span> Settings
            </a>
        </nav>
        <div style="padding: 1rem;">
            <a href="logout.php"
                style="display: flex; align-items: center; gap: 1rem; padding: 1rem; color: #F87171; text-decoration: none; font-weight: 700; border-radius: 1rem; transition: 0.3s;">
                <span>🚪</span> Logout
            </a>
        </div>
    </aside>
    <main class="main-content">