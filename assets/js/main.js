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

  /* ---- contact form: validates, then emails the enquiry to Utkarsh ----
     Delivery uses FormSubmit (free, no server needed on GitHub Pages). Without
     JavaScript the form still posts to FormSubmit's normal endpoint. */
  const form = $('#contact-form');
  if (form) {
    const done = $('#contact-done'), status = $('.form-status', form), btn = $('button[type=submit]', form);
    const label = $('.btn-label', btn);
    const rules = {
      name:    v => v.trim().length >= 2 ? '' : 'Please enter your name.',
      email:   v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) ? '' : 'Please enter a valid email address.',
      phone:   v => { v = v.trim(); if (!v) return ''; const d = v.replace(/\D/g, '');
                      return /^[+()\d][\d\s().-]*$/.test(v) && d.length >= 7 && d.length <= 15 ? '' : 'Please enter a valid phone number, or leave it empty.'; },
      message: v => v.trim().length >= 5 ? '' : 'Please write a short message.',
    };
    const check = el => {
      const msg = rules[el.name] ? rules[el.name](el.value) : '';
      const box = el.closest('.field');
      box.classList.toggle('bad', !!msg);
      el.setAttribute('aria-invalid', msg ? 'true' : 'false');
      $('.err', box).textContent = msg;
      return !msg;
    };
    const fields = $$('input[name=name], input[name=email], input[name=phone], textarea[name=message]', form);
    fields.forEach(el => {
      el.addEventListener('blur', () => { if (el.value || el.closest('.field').classList.contains('bad')) check(el); });
      el.addEventListener('input', () => { if (el.closest('.field').classList.contains('bad')) check(el); });
    });

    const showError = () => {
      const v = n => form.elements[n].value.trim();
      const body = encodeURIComponent(`Name: ${v('name')}\nEmail: ${v('email')}\nPhone: ${v('phone') || 'Not provided'}\n\n${v('message')}`);
      const mail = `mailto:${form.dataset.mailto}?subject=${encodeURIComponent(form.dataset.subject)}&body=${body}`;
      status.className = 'form-status is-error';
      status.textContent = 'Sorry, that did not go through. Please try again, or ';
      const a = document.createElement('a'); a.href = mail; a.textContent = 'email Utkarsh directly'; status.append(a, '.');
    };

    const openedAt = Date.now();
    form.addEventListener('submit', async e => {
      const ok = fields.map(check).every(Boolean);       // check every field, show all errors
      if (!ok) { e.preventDefault(); const bad = fields.find(f => f.closest('.field').classList.contains('bad')); bad && bad.focus(); return; }
      if (!window.fetch) return;                          // no fetch: let the normal POST happen
      e.preventDefault();
      if (form.elements._honey.value || Date.now() - openedAt < 2500) { status.className = 'form-status'; showDone(); return; } // bots: silently "succeed"
      status.className = 'form-status'; status.textContent = '';
      form.classList.add('is-sending'); label.textContent = 'Sending…'; btn.setAttribute('aria-disabled', 'true');
      const v = n => form.elements[n].value.trim();
      const payload = {
        name: v('name'), email: v('email'), phone: v('phone') || 'Not provided', message: v('message'),
        _subject: `${form.dataset.subject} — ${v('name')}`, _template: 'table', _captcha: 'false',
      };
      try {
        const res = await fetch(form.dataset.endpoint, {
          method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify(payload),
        });
        const data = await res.json().catch(() => ({}));
        if (res.ok && (data.success === true || data.success === 'true')) showDone();
        else throw new Error(data.message || 'send failed');
      } catch (err) {
        showError();
      } finally {
        form.classList.remove('is-sending'); label.textContent = 'Send message'; btn.removeAttribute('aria-disabled');
      }
    });

    const showDone = () => {
      const first = form.elements.name.value.trim().split(/\s+/)[0];
      $('[data-name]', done).textContent = first ? ', ' + first : '';
      $('[data-email]', done).textContent = form.elements.email.value.trim();
      form.hidden = true; done.hidden = false; done.focus({ preventScroll: true });
      done.scrollIntoView({ block: 'nearest', behavior: reduce ? 'auto' : 'smooth' });
    };
    $('.cdone-again', done).addEventListener('click', () => {
      form.reset(); fields.forEach(el => { el.closest('.field').classList.remove('bad'); el.removeAttribute('aria-invalid'); });
      done.hidden = true; form.hidden = false; form.elements.name.focus();
    });
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
