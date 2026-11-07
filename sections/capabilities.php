<?php $k = $c['capabilities']; $total = count($k['parts']); ?>
<section class="sec sec--light" id="capabilities">
  <div class="wrap">
    <?php sec_head($k['label']); ?>
    <h2 class="h1 reveal"><?= e($k['title']) ?></h2>

    <?php foreach ($k['parts'] as $pi => $part): ?>
      <div class="cap-part">
        <aside class="cap-aside">
          <span class="eyebrow">Capabilities · Part <?= $pi + 1 ?> of <?= $total ?></span>
          <span class="outline outline--ink reveal"><?= e($part['range']) ?></span>
          <h3 class="reveal"><?= e($part['title']) ?></h3>
          <p><?= e($part['text']) ?></p>
          <ul class="pillars">
            <?php foreach ($part['pillars'] as $p): ?><li><?= e($p) ?></li><?php endforeach; ?>
          </ul>
        </aside>
        <div class="cap-grid">
          <?php foreach ($part['items'] as $ii => [$n, $tag, $title, $text]): ?>
            <article class="card reveal" style="--d:<?= $ii * .06 ?>s">
              <header><span class="n"><?= e($n) ?></span><span class="tag"><?= e($tag) ?></span></header>
              <h4><?= e($title) ?></h4>
              <p><?= e($text) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <p class="fine"><?= e($c['results']['disclaimer']) ?></p>
  </div>
</section>
