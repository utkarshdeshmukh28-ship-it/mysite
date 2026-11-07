<?php $p = $c['problem']; ?>
<section class="sec sec--yellow problem" id="problem">
  <div class="wrap">
    <?php sec_head($p['label']); ?>
    <h2 class="display reveal"><?= e($p['title']) ?></h2>
    <p class="lead reveal" style="--d:.1s"><?= e($p['text']) ?></p>
  </div>
</section>
