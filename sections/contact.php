<?php $k = $c['contact']; ?>
<section class="sec sec--dark contact" id="contact">
  <div class="ghost" aria-hidden="true">UTKARSH</div>
  <div class="wrap">
    <?php sec_head($k['label']); ?>
    <div class="contact-grid">
      <div>
        <span class="eyebrow accent"><?= e($k['kicker']) ?></span>
        <h2 class="display reveal"><?= e($k['first']) ?><br><?= e($k['last']) ?></h2>
        <p class="who"><?= e($k['role']) ?><br><?= e($k['tagline']) ?></p>
      </div>
      <div class="reach">
        <div class="reach-row reveal">
          <span class="eyebrow">Email</span>
          <a class="big-link" href="mailto:<?= e($k['email']) ?>"><?= e($k['email']) ?></a>
        </div>
        <div class="reach-row reveal" style="--d:.08s">
          <span class="eyebrow">Phone</span>
          <?php foreach ($k['phones'] as [$show, $tel]): ?>
            <a class="big-link" href="tel:<?= e($tel) ?>"><?= e($show) ?></a>
          <?php endforeach; ?>
        </div>
        <a class="btn reveal" style="--d:.15s" href="mailto:<?= e($k['email']) ?>?subject=Let%E2%80%99s%20talk%20brand">Start a conversation →</a>
      </div>
    </div>
  </div>
</section>
