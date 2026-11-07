<?php
/**
 * Pre-render index.php → index.html for static hosting (GitHub Pages).
 * Usage:  php build.php
 */
chdir(__DIR__);
ob_start();
include __DIR__ . '/index.php';
$html = ob_get_clean();
file_put_contents(__DIR__ . '/index.html', $html);
echo "Built index.html (" . number_format(strlen($html)) . " bytes)\n";
