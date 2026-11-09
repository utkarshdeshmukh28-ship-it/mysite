</main>

<footer class="foot sec--dark">
  <div class="wrap foot-in">
    <span><?= e($c['site']['name']) ?> · Company Profile <?= e($c['site']['year']) ?></span>
    <span><?= e($c['contact']['tagline']) ?></span>
    <a href="#top" class="to-top">Back to top ↑</a>
  </div>
</footer>

<dialog class="lightbox" id="lightbox" aria-label="Image viewer">
  <button type="button" class="lb-close" aria-label="Close">×</button>
  <img alt="">
  <p class="lb-cap"></p>
</dialog>

<script src="assets/js/main.js?v=<?= filemtime(__DIR__ . '/../assets/js/main.js') ?>" defer></script>
</body>
</html>
