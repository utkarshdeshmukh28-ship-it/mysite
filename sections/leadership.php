<?php $l = $c['leadership']; ?>
<section class="sec--dark leader" id="leadership">
  <figure class="leader-photo reveal">
    <?= img('founder.jpg', $l['first'] . ' ' . $l['last'] . ', ' . $l['role'] . '') ?>
  </figure>
  <div class="leader-copy">
    <span class="eyebrow"><?= e($l['label']) ?></span>
    <h2 class="display reveal"><?= e($l['first']) ?><br><?= e($l['last']) ?></h2>
    <p class="role reveal" style="--d:.05s"><?= e($l['role']) ?></p>
    <p class="lead reveal" style="--d:.1s"><?= e($l['text']) ?></p>
    <dl class="stats stats--tight reveal" style="--d:.15s">
      <?php foreach ($c['stats'] as [$n, $lbl]): ?>
        <div><dt><?= e($n) ?></dt><dd><?= e($lbl) ?></dd></div>
      <?php endforeach; ?>
    </dl>
  </div>
</section>
