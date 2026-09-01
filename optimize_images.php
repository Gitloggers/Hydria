<?php
/**
 * Image Optimization Utility
 * Run this script to compress existing large images in the assets folder
 *
 * Usage: php optimize_images.php
 */

$assetDir = __DIR__ . '/assets/';
$optimized = 0;
$saved_bytes = 0;

// Files to optimize (PNG files that should be smaller)
$files_to_optimize = [
    'villa.png' => ['max_width' => 1200, 'quality' => 80],
    'Nextvas.png' => ['max_width' => 1200, 'quality' => 80],
    'logo.png' => ['max_width' => 400, 'quality' => 85],
];

echo "=== Hydria Image Optimization ===\n\n";

foreach ($files_to_optimize as $filename => $options) {
    $filepath = $assetDir . $filename;

    if (!file_exists($filepath)) {
        echo "⚠️  Skipping $filename - file not found\n";
        continue;
    }

    $original_size = filesize($filepath);
    $img_info = getimagesize($filepath);

    if (!$img_info) {
        echo "⚠️  Skipping $filename - not a valid image\n";
        continue;
    }

    $width = $img_info[0];
    $height = $img_info[1];
    $mime = $img_info['mime'];

    echo "Processing: $filename\n";
    echo "  Original: " . round($original_size / 1024, 1) . " KB ({$width}x{$height})\n";

    // Calculate new dimensions
    $max_width = $options['max_width'];
    if ($width > $max_width) {
        $new_width = $max_width;
        $new_height = (int)($height * ($max_width / $width));
    } else {
        $new_width = $width;
        $new_height = $height;
    }

    // Load image
    switch ($mime) {
        case 'image/png':
            $image = imagecreatefrompng($filepath);
            break;
        case 'image/jpeg':
            $image = imagecreatefromjpeg($filepath);
            break;
        default:
            echo "  ⚠️  Unsupported format: $mime\n\n";
            continue 2;
    }

    if (!$image) {
        echo "  ❌ Failed to load image\n\n";
        continue;
    }

    // Resize if needed
    if ($new_width !== $width || $new_height !== $height) {
        $resized = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 255, 255, 255, 127);
        imagefilledrectangle($resized, 0, 0, $new_width, $new_height, $transparent);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagedestroy($image);
        $image = $resized;
        echo "  Resized to: {$new_width}x{$new_height}\n";
    }

    // Save as WebP
    $new_filename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
    $new_filepath = $assetDir . $new_filename;

    if (imagewebp($image, $new_filepath, $options['quality'])) {
        $new_size = filesize($new_filepath);
        $saved = $original_size - $new_size;
        $percent = round(($saved / $original_size) * 100, 1);

        echo "  ✅ Created: $new_filename (" . round($new_size / 1024, 1) . " KB)\n";
        echo "  💾 Saved: " . round($saved / 1024, 1) . " KB ($percent% reduction)\n";

        $optimized++;
        $saved_bytes += $saved;

        // Optionally delete original
        // unlink($filepath);
    } else {
        echo "  ❌ Failed to create WebP\n";
    }

    imagedestroy($image);
    echo "\n";
}

echo "=== Summary ===\n";
echo "Optimized: $optimized images\n";
echo "Total saved: " . round($saved_bytes / 1024, 1) . " KB\n";
echo "\nNote: Original PNG files preserved. Delete manually after verifying WebP versions.\n";
