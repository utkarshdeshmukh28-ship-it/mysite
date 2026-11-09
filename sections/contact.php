<?php
$k = $c['contact']; $f = $k['form'];
$icons = [
  'user'  => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
  'mail'  => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
  'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
  'msg'   => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
];
$ico = fn(string $n) => '<svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $icons[$n] . '</svg>';
?>
<section class="sec sec--dark contact" id="contact">
  <div class="ghost" aria-hidden="true">UTKARSH</div>
  <div class="wrap">
    <?php sec_head($k['label']); ?>
    <div class="contact-grid">

      <div class="contact-main">
        <span class="eyebrow accent reveal"><?= e($k['kicker']) ?></span>
        <h2 class="display reveal" style="--d:.05s"><?= e($f['title']) ?></h2>
        <p class="lead reveal" style="--d:.1s"><?= e($f['text']) ?></p>

        <form class="cform reveal" style="--d:.15s" id="contact-form" method="POST" action="https://formsubmit.co/<?= e($k['email']) ?>"
              data-endpoint="https://formsubmit.co/ajax/<?= e($k['email']) ?>" data-subject="<?= e($f['subject']) ?>" data-mailto="<?= e($k['email']) ?>" novalidate>
          <input type="hidden" name="_subject" value="<?= e($f['subject']) ?>">
          <input type="hidden" name="_template" value="table">
          <input type="hidden" name="_captcha" value="false">
          <div class="hp" aria-hidden="true"><label>Leave this empty <input type="text" name="_honey" tabindex="-1" autocomplete="off"></label></div>

          <div class="field">
            <label class="sr" for="cf-name">Name</label>
            <?= $ico('user') ?>
            <input id="cf-name" name="name" type="text" placeholder="Name" autocomplete="name" maxlength="80" required aria-describedby="cf-name-err">
            <p class="err" id="cf-name-err" role="alert"></p>
          </div>
          <div class="field">
            <label class="sr" for="cf-email">Email</label>
            <?= $ico('mail') ?>
            <input id="cf-email" name="email" type="email" placeholder="Email" autocomplete="email" inputmode="email" maxlength="120" required aria-describedby="cf-email-err">
            <p class="err" id="cf-email-err" role="alert"></p>
          </div>
          <div class="field">
            <label class="sr" for="cf-phone">Phone number (optional)</label>
            <?= $ico('phone') ?>
            <input id="cf-phone" name="phone" type="tel" placeholder="Phone number (optional)" autocomplete="tel" inputmode="tel" maxlength="24" aria-describedby="cf-phone-err">
            <p class="err" id="cf-phone-err" role="alert"></p>
          </div>
          <div class="field field--area">
            <label class="sr" for="cf-message">Message</label>
            <?= $ico('msg') ?>
            <textarea id="cf-message" name="message" placeholder="Message" rows="5" maxlength="2000" required aria-describedby="cf-message-err"></textarea>
            <p class="err" id="cf-message-err" role="alert"></p>
          </div>

          <button class="btn btn--block" type="submit"><span class="btn-label">Send message</span><span class="btn-arrow" aria-hidden="true">→</span><span class="spin" aria-hidden="true"></span></button>
          <p class="form-note"><?= e($f['note']) ?></p>
          <div class="form-status" role="status" aria-live="polite" tabindex="-1"></div>
        </form>

        <div class="cdone" id="contact-done" hidden tabindex="-1">
          <span class="tick"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
          <h3 class="cdone-title">Thank you<span data-name></span>.</h3>
          <p>Your message is on its way to Utkarsh. He will reply to <strong data-email></strong>.</p>
          <button type="button" class="btn btn-sm cdone-again">Send another message</button>
        </div>
      </div>

      <aside class="contact-side">
        <div class="illus reveal" style="--d:.1s"><?php include __DIR__ . '/../includes/contact-illustration.php'; ?></div>
        <div class="who-card reveal" style="--d:.15s">
          <p class="who-name"><?= e($k['first']) ?> <?= e($k['last']) ?></p>
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
        </div>
      </aside>

    </div>
  </div>
</section>
