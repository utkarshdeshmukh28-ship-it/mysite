<?php $cl = $c['clients']; ?>
<section class="sec sec--light" id="clients">
  <div class="wrap">
    <?php sec_head($cl['label']); ?>
    <h2 class="h2 reveal"><?= e($cl['title']) ?></h2>

    <div class="logo-grid">
      <?php foreach ($cl['categories'] as $i => [$cat, $file, $alt]): ?>
        <figure class="logo-card reveal" style="--d:<?= ($i % 5) * .05 ?>s">
          <figcaption><?= e($cat) ?></figcaption>
          <?= img($file, $alt . ' logos') ?>
        </figure>
      <?php endforeach; ?>
    </div>

    <h3 class="eyebrow more-label"><?= e($cl['more_label']) ?></h3>
    <ul class="more">
      <?php foreach ($cl['more'] as $name): ?><li><?= e($name) ?></li><?php endforeach; ?>
    </ul>

    <div class="banner banner--center reveal"><span class="banner-text"><?= e(strtoupper($cl['banner'])) ?></span></div>
  </div>
</section>
