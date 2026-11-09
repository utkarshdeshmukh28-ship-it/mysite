<?php $s = $c['site']; $url = rtrim($s['url'], '/'); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title><?= e($s['title']) ?></title>
  <meta name="description" content="<?= e($s['description']) ?>">
  <meta name="theme-color" content="#0f0f0f">
  <meta name="color-scheme" content="dark light">
<?php if ($url): ?>
  <link rel="canonical" href="<?= e($url) ?>/">
  <meta property="og:url" content="<?= e($url) ?>/">
  <meta property="og:image" content="<?= e($url) ?>/assets/img/founder.jpg">
<?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= e($s['title']) ?>">
  <meta property="og:description" content="<?= e($s['description']) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="icon" href="assets/favicon.svg" type="image/svg+xml">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
  <script>document.documentElement.classList.add('js');setTimeout(function(){if(!window.__rvReady)document.documentElement.classList.remove('js')},4000);</script>
  <script type="application/ld+json">
  <?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'ProfessionalService',
    'name'     => $s['name'],
    'description' => $s['description'],
    'founder'  => ['@type' => 'Person', 'name' => $c['contact']['first'] . ' ' . $c['contact']['last']],
    'email'    => $c['contact']['email'],
    'telephone'=> array_column($c['contact']['phones'], 1),
  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>

  </script>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<div class="progress" aria-hidden="true"><span></span></div>

<header class="nav" id="top">
  <div class="wrap nav-in">
    <a class="brand" href="#top" aria-label="<?= e($s['name']) ?> — home"><span class="brand-dot"></span>UTKARSH <span class="brand-sub">DESHMUKH</span></a>
    <nav id="menu" class="menu" aria-label="Primary">
      <?php foreach ($c['nav'] as [$href, $label]): ?>
        <a href="<?= e($href) ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>
    <a class="btn btn-sm nav-cta" href="#contact">Talk to us</a>
    <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="menu"><span></span><span></span></button>
  </div>
</header>

<main id="main">
