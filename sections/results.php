<?php $r = $c['results']; $cs = $r['case']; $g = $r['growth']; $roi = $r['roi']; $en = $r['engagement']; ?>
<section class="sec sec--dark" id="results">
  <div class="wrap">
    <?php sec_head($cs['label']); ?>
    <div class="case">
      <div class="case-intro">
        <h2 class="h1 reveal"><?= e($cs['title']) ?></h2>
        <p class="lead reveal" style="--d:.1s"><?= e($cs['text']) ?></p>
      </div>
      <div class="case-data reveal">
        <span class="eyebrow"><?= e($cs['metric_label']) ?></span>
        <div class="big-row">
          <span class="mega accent"><span data-count="<?= $cs['big'] ?>">0</span><?= e($cs['big_suffix']) ?></span>
          <p><?= e($cs['big_text']) ?></p>
        </div>
        <div class="hbar"><span class="lbl"><?= e($cs['before'][0]) ?></span><span class="track"><span class="fill fill--dim" style="--w:<?= $cs['before'][2] ?>%"></span></span><span class="val"><?= e($cs['before'][1]) ?></span></div>
        <div class="hbar hbar--now"><span class="lbl"><?= e($cs['now'][0]) ?></span><span class="track"><span class="fill" style="--w:<?= $cs['now'][2] ?>%"></span></span><span class="val accent"><?= e($cs['now'][1]) ?></span></div>
        <dl class="minis">
          <?php foreach ($cs['minis'] as [$n, $l]): ?><div><dt><?= e($n) ?></dt><dd><?= e($l) ?></dd></div><?php endforeach; ?>
        </dl>
      </div>
    </div>
  </div>
</section>

<section class="sec sec--dark sec--tight" id="growth">
  <div class="wrap">
    <?php sec_head($g['label']); ?>
    <h2 class="h1 reveal"><?= e($g['title']) ?></h2>
    <div class="growth">
      <?php foreach ($g['cards'] as $i => [$name, $pre, $num, $suf, $desc, $after]): ?>
        <article class="gcard reveal<?= $i === 0 ? ' gcard--hot' : '' ?>" style="--d:<?= $i * .08 ?>s">
          <span class="eyebrow<?= $i === 0 ? ' accent' : '' ?>"><?= e($name) ?></span>
          <p class="mega"><?= e($pre) ?><span data-count="<?= $num ?>">0</span><?= e($suf) ?></p>
          <p class="desc"><?= e($desc) ?></p>
          <span class="eyebrow"><?= e($g['index_label']) ?></span>
          <div class="vbars" role="img" aria-label="Before 100, after <?= $after ?>">
            <div><span class="v" style="--h:<?= round(100 / 400 * 100) ?>%"><b>100</b></span><em>Before</em></div>
            <div><span class="v v--hot" style="--h:<?= round($after / 400 * 100) ?>%"><b><?= $after ?></b></span><em>After</em></div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="banner banner--solid reveal"><span class="banner-text"><?= e($g['banner']) ?></span></div>
    <p class="fine"><?= e($r['disclaimer']) ?></p>
  </div>
</section>

<section class="sec sec--light" id="roi">
  <div class="wrap">
    <?php sec_head($roi['label']); ?>
    <div class="roi-top">
      <span class="giant reveal"><span data-count="<?= $roi['big'] ?>">0</span><i>×</i></span>
      <div class="roi-copy reveal" style="--d:.1s">
        <span class="bar" aria-hidden="true"></span>
        <h2 class="h2"><?= e($roi['title']) ?></h2>
        <p><?= e($roi['text']) ?></p>
      </div>
    </div>
    <dl class="roi-list">
      <?php foreach ($roi['items'] as $i => [$n, $l]): ?>
        <div class="reveal" style="--d:<?= $i * .06 ?>s"><dt><span data-count="<?= $n ?>">0</span>×</dt><dd><?= e($l) ?></dd></div>
      <?php endforeach; ?>
    </dl>
    <p class="fine"><?= e($r['disclaimer']) ?></p>
  </div>
</section>

<section class="sec sec--light sec--flush" id="engagement">
  <div class="wrap">
    <?php sec_head($en['label']); ?>
    <h2 class="h1 reveal"><?= e($en['title']) ?></h2>
    <div class="eng">
      <div class="eng-bars">
        <p class="cap"><?= e($en['caption']) ?></p>
        <?php $max = max(array_column($en['bars'], 1)); foreach ($en['bars'] as $i => [$l, $v]): ?>
          <div class="erow<?= $i === 0 ? ' erow--top' : '' ?>">
            <span class="lbl"><?= e($l) ?></span>
            <span class="track"><span class="fill" style="--w:<?= round($v / $max * 100) ?>%"></span></span>
            <span class="val"><span data-count="<?= $v ?>">0</span>×</span>
          </div>
        <?php endforeach; ?>
      </div>
      <aside class="callout reveal">
        <span class="eyebrow accent"><?= e($en['callout_label']) ?></span>
        <p class="mega accent">+<span data-count="<?= $en['callout_big'] ?>">0</span>%</p>
        <p><?= e($en['callout_text']) ?></p>
      </aside>
    </div>
    <p class="fine"><?= e($r['disclaimer']) ?></p>
  </div>
</section>
