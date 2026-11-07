<?php $s = $c['services']; ?>
<section class="sec sec--dark sec--tight" id="services">
  <div class="wrap">
    <?php sec_head($s['label']); ?>
    <h2 class="h1 reveal"><?= e($s['title']) ?></h2>
    <ol class="services">
      <?php foreach ($s['items'] as $i => [$t, $d]): ?>
        <li class="reveal" style="--d:<?= ($i % 4) * .06 ?>s">
          <span class="no accent"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <div><h3><?= e($t) ?></h3><p><?= e($d) ?></p></div>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
