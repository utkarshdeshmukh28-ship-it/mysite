/* Grayscale Ventures — tiny, dependency-free enhancements.
   The site is fully readable without JavaScript. */
(() => {
  'use strict';
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const $  = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];

  /* ---- mobile menu ---- */
  const burger = $('.burger'), menu = $('#menu');
  const setMenu = open => {
    menu.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open);
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  };
  burger?.addEventListener('click', () => setMenu(!menu.classList.contains('open')));
  menu?.addEventListener('click', e => { if (e.target.closest('a')) setMenu(false); });
  addEventListener('keydown', e => { if (e.key === 'Escape') setMenu(false); });
  matchMedia('(min-width:1024px)').addEventListener('change', () => setMenu(false));

  /* ---- scroll progress + active nav link ---- */
  const bar = $('.progress span');
  const links = $$('.menu a');
  const targets = links.map(a => $(a.getAttribute('href'))).filter(Boolean);
  let ticking = false;
  const onScroll = () => {
    if (ticking) return; ticking = true;
    requestAnimationFrame(() => {
      const h = document.documentElement;
      const max = h.scrollHeight - innerHeight;
      if (bar) bar.style.transform = `scaleX(${max > 0 ? Math.min(scrollY / max, 1) : 0})`;
      const y = scrollY + innerHeight * 0.35;
      let cur = null;
      targets.forEach(t => { if (t.offsetTop <= y) cur = t.id; });
      links.forEach(a => a.classList.toggle('on', a.getAttribute('href') === '#' + cur));
      ticking = false;
    });
  };
  addEventListener('scroll', onScroll, { passive: true });
  addEventListener('resize', onScroll, { passive: true });
  onScroll();

  /* ---- count-up numbers ---- */
  const count = el => {
    const end = parseFloat(el.dataset.count);
    if (reduce || !isFinite(end)) { el.textContent = end; return; }
    const dur = 1400, t0 = performance.now();
    const tick = now => {
      const p = Math.min((now - t0) / dur, 1);
      el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3)));
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };

  /* ---- reveal on scroll ---- */
  const revealables = $$('.reveal, .fill, .vbars');
  const counters = $$('[data-count]');
  if (!('IntersectionObserver' in window)) {
    revealables.forEach(el => el.classList.add('in'));
    counters.forEach(el => el.textContent = el.dataset.count);
  } else {
    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(en => {
        if (!en.isIntersecting) return;
        const el = en.target;
        el.classList.add('in');
        $$('[data-count]', el).forEach(count);
        if (el.matches('[data-count]')) count(el);
        obs.unobserve(el);
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -6% 0px' });
    revealables.forEach(el => io.observe(el));
    // standalone counters (not inside a .reveal) get their own observer
    counters.filter(c => !c.closest('.reveal')).forEach(c => io.observe(c));
    // failsafe: never leave content hidden
    setTimeout(() => revealables.forEach(el => el.classList.add('in')), 4000);
  }

  /* ---- gallery lightbox ---- */
  const lb = $('#lightbox');
  if (lb && typeof lb.showModal === 'function') {
    const img = $('img', lb), cap = $('.lb-cap', lb);
    $$('.tile').forEach(t => t.addEventListener('click', () => {
      img.src = t.dataset.full; img.alt = t.dataset.alt; cap.textContent = t.dataset.alt;
      lb.showModal();
    }));
    lb.addEventListener('click', e => { if (e.target !== img) lb.close(); });
    lb.addEventListener('close', () => { img.removeAttribute('src'); });
  } else {
    $$('.tile').forEach(t => t.style.cursor = 'default');
  }
})();
