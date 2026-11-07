<?php $s = $c['start']; ?>
<section class="sec sec--yellow start" id="start">
  <div class="wrap">
    <?php sec_head($s['label']); ?>
    <h2 class="display reveal"><?= e($s['title']) ?></h2>
    <ol class="start-steps">
      <?php foreach ($s['steps'] as $i => [$n, $t, $d]): ?>
        <li class="reveal" style="--d:<?= $i * .08 ?>s"><span class="n"><?= e($n) ?></span><h3><?= e($t) ?></h3><p><?= e($d) ?></p></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
