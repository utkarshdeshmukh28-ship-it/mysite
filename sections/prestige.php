<?php $p = $c['prestige']; ?>
<section class="sec sec--dark" id="prestige">
  <div class="wrap">
    <?php sec_head($p['label']); ?>
    <?php foreach ($p['galleries'] as $g): ?>
      <div class="gallery-block">
        <h2 class="h2 reveal"><?= e($g['title']) ?></h2>
        <div class="gallery">
          <?php foreach ($g['items'] as [$file, $alt]): $r = ratio($file); ?>
            <button type="button" class="tile reveal" style="--r:<?= $r ?>" data-full="assets/img/<?= e($file) ?>" data-alt="<?= e($alt) ?>" aria-label="View: <?= e($alt) ?>">
              <?= img($file, $alt) ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <p class="fine"><?= e($p['copyright']) ?></p>
  </div>
</section>
