<?php
// Router for PHP built-in server to simulate XAMPP htdocs structure
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = __DIR__ . $uri;

// Serve static files directly
if ($uri !== '/' && file_exists($path) && !is_dir($path)) {
    return false;
}

// Strip /Hydria_Website prefix if present
if (strpos($uri, '/Hydria_Website/') === 0) {
    $uri = substr($uri, strlen('/Hydria_Website'));
}

$file = __DIR__ . $uri;

// If file exists, serve it
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Route / to api/index.php
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/api/index.php';
    return true;
}

// If ends in .php, try the file
if (substr($uri, -4) === '.php' && file_exists(__DIR__ . $uri)) {
    require __DIR__ . $uri;
    return true;
}

// Try root wrapper for api/ files
if (strpos($uri, '/api/') === 0) {
    $root = __DIR__ . substr($uri, 4);
    if (file_exists($root)) {
        require $root;
        return true;
    }
    require __DIR__ . $uri;
    return true;
}

// 404
http_response_code(404);
echo "Not found: $uri";
return true;
