<?php
/**
 * Utkarsh Deshmukh — one-page site.
 * Works on any PHP host (php -S localhost:8000) and is pre-rendered to
 * index.html by build.php so it also runs on GitHub Pages (static).
 */
require __DIR__ . '/includes/helpers.php';
$c = require __DIR__ . '/data/content.php';

include __DIR__ . '/includes/head.php';
foreach (['hero','problem','about','leadership','method','services','capabilities','clients','prestige','results','start','contact'] as $part) {
  include __DIR__ . '/sections/' . $part . '.php';
}
include __DIR__ . '/includes/footer.php';
