<?php $p = $c['prestige']; $last = count($p['galleries']) - 1; ?>
<section class="sec sec--dark prestige" id="prestige">
  <?php foreach ($p['galleries'] as $gi => $g): ?>
    <div class="gblock<?= $gi === 0 ? ' gblock--first' : '' ?>">
      <div class="wrap">
        <?php if ($gi === 0) sec_head($p['label']); ?>
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
        <?php if ($gi === $last): ?><p class="fine"><?= e($p['copyright']) ?></p><?php endif; ?>
      </div>
    </div>
    <?php if (!empty($p['interludes'][$gi])): $it = $p['interludes'][$gi]; ?>
      <div class="interlude interlude--<?= e($it['tone']) ?>">
        <div class="wrap interlude-in">
          <div>
            <span class="eyebrow reveal"><?= e($it['eyebrow']) ?></span>
            <h3 class="interlude-title reveal" style="--d:.06s"><?= e($it['title']) ?></h3>
          </div>
          <div class="interlude-copy reveal" style="--d:.12s">
            <p><?= e($it['text']) ?></p>
            <?php if (!empty($it['chips'])): ?>
              <ul class="chips"><?php foreach ($it['chips'] as $chip): ?><li><?= e($chip) ?></li><?php endforeach; ?></ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</section>
