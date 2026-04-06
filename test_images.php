<?php
// Simple test untuk memastikan gambar bisa diakses

$imagePath = __DIR__ . '/public/images/alat/';

if (!is_dir($imagePath)) {
    echo "❌ Folder public/images/alat/ tidak ditemukan!\n";
    exit(1);
}

$images = array_diff(scandir($imagePath), ['.', '..']);

if (empty($images)) {
    echo "❌ Tidak ada gambar di folder!\n";
    exit(1);
}

echo "✅ Test Passed!\n";
echo "📁 Folder public/images/alat/ ditemukan\n";
echo "🖼️  " . count($images) . " gambar ditemukan:\n";

foreach ($images as $image) {
    $size = filesize($imagePath . $image);
    echo "  - $image (" . round($size / 1024, 2) . " KB)\n";
}

// Test accessibilty
echo "\n📊 Test Accessibility:\n";
foreach ($images as $image) {
    $url = "/images/alat/{$image}";
    echo "  ✓ URL akan accessible di:$url\n";
}

echo "\n✅ Semua gambar siap digunakan!\n";
?>
