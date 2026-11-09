# Utkarsh Deshmukh — Personal Website

A fast, responsive one-page website built from the *Company Profile 2026* deck.
Plain **HTML + PHP + CSS** with a sprinkle of vanilla JS. No frameworks, no build tools, no npm.

**Theme:** ink black `#0f0f0f` · paper `#f2f0ec` · signal yellow `#f9d84a` · Space Grotesk + Inter.

## Project layout

```
index.php            page entry (renders every section)
index.html           pre-rendered copy of index.php (what GitHub Pages serves)
build.php            php build.php  →  regenerates index.html
data/content.php     ALL text/numbers/image lists — edit copy here
includes/            head, footer, helpers
sections/            one file per page section
assets/css/style.css styles (mobile-first, CSS variables at the top)
assets/js/main.js    nav, scroll reveal, count-ups, lightbox
assets/img/          founder photo, client logos, campaign creatives
.github/workflows/   optional auto-deploy to GitHub Pages
```

## Run locally

With PHP installed:

```bash
php -S localhost:8000
# open http://localhost:8000
```

No PHP? Just open `index.html` in a browser — it is the same page.

## Host free on GitHub Pages

GitHub Pages is static hosting (it does not execute PHP), so the repo ships a pre-rendered `index.html`.

**Option A — simplest (no Actions):**
1. Push this folder to a GitHub repo.
2. *Settings → Pages → Build and deployment → Deploy from a branch → `main` / `/ (root)`*.
3. Your site is live at `https://<user>.github.io/<repo>/`.

**Option B — auto-build from PHP:**
*Settings → Pages → Source: **GitHub Actions**.* On every push to `main`, the included workflow runs `php build.php` and deploys.

Any normal PHP host (cPanel, shared hosting, VPS) can serve `index.php` directly.

## Page order (top to bottom)

Hero → Clients (brands served and promoted) → The Real Problem → Who We Are → Leadership → Method → Services →
Prestige galleries (with text interludes between them) → Proof / Results → Start Here → **Contact form** → Industries (the 17 kinds of business).
The order is set in one line in `index.php`; the nav links in `data/content.php` must follow the same order.

## Contact form → your Gmail

The form on the Contact section emails every enquiry (Name, Email, optional Phone, Message) to the address in
`data/content.php → contact → email`, using the free [FormSubmit](https://formsubmit.co) service (no server needed).

**One-time activation (required):** after the site is live, send yourself one test message from the form.
FormSubmit emails an *Activate Form* link to that Gmail address (check Spam / Promotions). Click it once. From then on
every enquiry arrives in your inbox within seconds. Replying to the email replies straight to the visitor.

If sending ever fails, the visitor sees a message with a pre-filled "email directly" link, so no lead is lost.

## Editing

1. Change text in `data/content.php` (or images in `assets/img/`).
2. Run `php build.php` to refresh `index.html` (Option A) — or just push (Option B).
3. Set `site.url` in `data/content.php` to your live URL to enable canonical + social-preview tags.

## Notes

- Campaign creatives and client logos are © their respective owners and shown as work promoted by Utkarsh Deshmukh.
- Figures are *directionally scaled for clarity*, as stated in the original profile.
