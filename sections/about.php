<?php $a = $c['about']; ?>
<section class="sec sec--light" id="about">
  <div class="wrap">
    <?php sec_head($a['label']); ?>
    <div class="split">
      <div>
        <h2 class="h1 reveal"><?= e($a['title']) ?></h2>
        <span class="bar reveal" aria-hidden="true"></span>
        <p class="lead reveal" style="--d:.1s"><?= e($a['text']) ?></p>
      </div>
      <ol class="points">
        <?php foreach ($a['points'] as $i => [$t, $d]): ?>
          <li class="reveal" style="--d:<?= $i * .07 ?>s">
            <span class="no"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
            <h3><?= e($t) ?></h3>
            <p><?= e($d) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>
