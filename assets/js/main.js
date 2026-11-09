/* Grayscale Ventures — tiny, dependency-free enhancements.
   The site is fully readable without JavaScript. */
(() => {
  'use strict';
  window.__rvReady = true; // tells the head failsafe that the script loaded
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
  let tops = [], ticking = false;
  const measure = () => { tops = targets.map(t => [t.id, t.offsetTop]); };
  const onScroll = () => {
    if (ticking) return; ticking = true;
    requestAnimationFrame(() => {
      const h = document.documentElement;
      const max = h.scrollHeight - innerHeight;
      if (bar) bar.style.transform = `scaleX(${max > 0 ? Math.min(scrollY / max, 1) : 0})`;
      const y = scrollY + innerHeight * 0.35;
      let cur = null;
      for (const [id, top] of tops) if (top <= y) cur = id;
      links.forEach(a => a.classList.toggle('on', a.getAttribute('href') === '#' + cur));
      ticking = false;
    });
  };
  measure(); onScroll();
  addEventListener('scroll', onScroll, { passive: true });
  if ('ResizeObserver' in window) new ResizeObserver(() => { measure(); onScroll(); }).observe(document.body);
  else addEventListener('resize', () => { measure(); onScroll(); }, { passive: true });

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

  /* ---- reveal on scroll ----
     Each element fades/rises once (1s, eased) as it enters the screen.
     - starts after fonts are ready, so nothing jumps while the page settles
     - fires the moment an element crosses the trigger line (works on phones too)
     - elements arriving together are staggered a little, capped so it never drags
     - elements already scrolled past (anchor jump / refresh mid-page) show instantly */
  const revealables = $$('.reveal, .fill, .vbars');
  const counters = $$('[data-count]');
  const showAll = () => {
    revealables.forEach(el => el.classList.add('in'));
    counters.forEach(el => el.textContent = el.dataset.count);
  };
  if (!('IntersectionObserver' in window)) {
    showAll();
  } else {
    const STEP = 0.075, MAX_STEPS = 5;
    const io = new IntersectionObserver(entries => {
      const entering = entries.filter(en => en.isIntersecting)
        .sort((a, b) => a.boundingClientRect.top - b.boundingClientRect.top || a.boundingClientRect.left - b.boundingClientRect.left);
      let n = 0;
      entering.forEach(en => {
        const el = en.target;
        if (el.classList.contains('reveal') && !el.style.getPropertyValue('--d')) {
          el.style.setProperty('--d', (Math.min(n++, MAX_STEPS) * STEP).toFixed(3) + 's');
        }
        el.classList.add('in');
        $$('[data-count]', el).forEach(count);
        if (el.matches('[data-count]')) count(el);
        io.unobserve(el);
      });
      entries.forEach(en => {
        if (en.isIntersecting || en.boundingClientRect.top >= 0) return;
        const el = en.target;                       // scrolled past before it was seen
        el.classList.add('in', 'rv-now');
        $$('[data-count]', el).forEach(c => { c.textContent = c.dataset.count; });
        io.unobserve(el);
      });
    }, { threshold: 0, rootMargin: '0px 0px -8% 0px' });

    let started = false;
    const start = () => {
      if (started) return; started = true;
      revealables.forEach(el => io.observe(el));
      counters.filter(c => !c.closest('.reveal')).forEach(c => io.observe(c));
    };
    const fonts = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();
    fonts.then(() => requestAnimationFrame(() => requestAnimationFrame(start)));
    setTimeout(start, 900);                         // never wait longer than this for fonts
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
