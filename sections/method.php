<?php $m = $c['method']; ?>
<section class="sec sec--dark" id="method">
  <div class="wrap">
    <?php sec_head($m['label']); ?>
    <h2 class="h1 reveal"><?= e($m['title']) ?></h2>
    <div class="steps">
      <?php foreach ($m['steps'] as $i => [$n, $t, $d, $get]): ?>
        <article class="step reveal" style="--d:<?= $i * .08 ?>s">
          <span class="outline"><?= e($n) ?></span>
          <h3><?= e($t) ?></h3>
          <p><?= e($d) ?></p>
          <div class="get"><span class="eyebrow">What you get</span><p><?= e($get) ?></p></div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="banner reveal">
      <span class="eyebrow"><?= e($m['threeLs_label']) ?></span>
      <span class="banner-text"><?= e(implode(' / ', $m['threeLs'])) ?></span>
    </div>
  </div>
</section>
