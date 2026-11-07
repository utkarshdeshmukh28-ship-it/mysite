<?php
/** Small template helpers. No framework, no dependencies. */

function e($s): string {
  return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Sequential section number shown in the top-right of each section header. */
function next_no(): string {
  static $n = 1;
  return str_pad((string)$n++, 2, '0', STR_PAD_LEFT);
}

/** Section header: label on the left, running number on the right, hairline below. */
function sec_head(string $label): void {
  echo '<div class="sec-head"><span class="eyebrow">' . e($label) . '</span><span class="sec-no" aria-hidden="true">' . next_no() . '</span></div>';
}

/** Responsive <img> with intrinsic size (no layout shift) and lazy loading. */
function img(string $file, string $alt, string $class = '', bool $eager = false): string {
  $path = __DIR__ . '/../assets/img/' . $file;
  $size = is_file($path) ? @getimagesize($path) : false;
  $wh   = $size ? ' width="' . (int)$size[0] . '" height="' . (int)$size[1] . '"' : '';
  $load = $eager ? ' fetchpriority="high"' : ' loading="lazy" decoding="async"';
  $cls  = $class !== '' ? ' class="' . e($class) . '"' : '';
  return '<img src="assets/img/' . e($file) . '" alt="' . e($alt) . '"' . $wh . $cls . $load . '>';
}

/** Aspect ratio of an image, used by the justified galleries. */
function ratio(string $file): float {
  $size = @getimagesize(__DIR__ . '/../assets/img/' . $file);
  return $size ? round($size[0] / $size[1], 3) : 1.0;
}
