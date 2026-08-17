<?php
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
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
    <meta name="description"
        content="Hydria Construction Inc. - 20 Years of Building Excellence in Los Baños and beyond. Providing top-tier residential, commercial, and industrial construction services.">
    <title>Hydria Construction Inc. | Building Excellence</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">



    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="<?php echo $base_path; ?>modern-ui.css?v=2.0">
</head>

<body class="bg-white">

    <!-- Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 navbar-glass">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="#home" class="flex items-center gap-3 group">
                <img src="<?php echo $base_path; ?>assets/logo.png" alt="Hydria Logo" class="h-10 w-auto transition-transform group-hover:scale-110">
                <span class="font-display text-2xl tracking-wider text-primary uppercase">HYDRIA</span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-10">
                <a href="#home" class="text-sm font-bold text-primary/70 hover:text-primary transition-colors">Home</a>
                <a href="#about"
                    class="text-sm font-bold text-primary/70 hover:text-primary transition-colors">About</a>
                <a href="#services"
                    class="text-sm font-bold text-primary/70 hover:text-primary transition-colors">Services</a>
                <a href="#projects"
                    class="text-sm font-bold text-primary/70 hover:text-primary transition-colors">Projects</a>
                <a href="#contact"
                    class="px-5 py-2.5 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary/90 transition-all hover:shadow-lg hover:shadow-primary/20">
                    Get a Quote
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button id="menu-btn" class="md:hidden text-primary">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden absolute top-full left-0 right-0 bg-white border-t border-gray-100 shadow-xl p-6 flex flex-col gap-4 animate-slide-down">
            <a href="#home" class="text-lg font-bold text-primary">Home</a>
            <a href="#about" class="text-lg font-bold text-primary">About</a>
            <a href="#services" class="text-lg font-bold text-primary">Services</a>
            <a href="#projects" class="text-lg font-bold text-primary">Projects</a>
            <a href="#contact" class="w-full py-4 bg-primary text-white text-center font-bold rounded-xl mt-2">Get a
                Quote</a>
        </div>
    </nav>