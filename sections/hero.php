<?php $h = $c['hero']; ?>
<section class="hero sec--dark" aria-labelledby="hero-title">
  <div class="rings" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><b></b></div>
  <div class="wrap hero-in">
    <div class="hero-top">
      <span class="eyebrow"><?= e($h['eyebrow']) ?></span>
    </div>
    <h1 id="hero-title" class="display">
      <span class="reveal"><?= e($h['line1']) ?></span><br>
      <span class="accent reveal" style="--d:.1s"><?= e($h['line2']) ?></span>
    </h1>
    <p class="lead reveal" style="--d:.2s"><?= e($h['sub']) ?></p>
    <span class="bar reveal" style="--d:.3s" aria-hidden="true"></span>

    <div class="hero-foot">
      <dl class="stats reveal" style="--d:.35s">
        <?php foreach ($c['stats'] as [$n, $l]): ?>
          <div><dt><?= e($n) ?></dt><dd><?= e($l) ?></dd></div>
        <?php endforeach; ?>
      </dl>
      <p class="origin reveal" style="--d:.45s"><?= e($h['tag'][0]) ?><br><?= e($h['tag'][1]) ?></p>
    </div>
  </div>
</section>
