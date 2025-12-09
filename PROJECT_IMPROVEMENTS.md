# Project Improvement Plan (NovaCreator Studio)

## UX & Accessibility (High)
- Lock focus inside the burger menu when opened, restore to the trigger on close; add `aria-expanded`/`aria-controls` to the new IDs and ensure Escape/overlay close work reliably.
- Add visible focus states for all interactive elements (links, buttons, toggles) in light and dark themes; remove inline `onmouseover/onmouseout` handlers in `includes/header.php` and move hover/focus styles to CSS.
- Respect `prefers-reduced-motion` for all animations (menu, gradients, counters, scroll effects) and reduce haptic feedback intensity on mobile.
- Add a “Skip to content” link and ensure landmarks (`<main>`, `<nav>`, `<footer>`) are present on every page.
- Check color contrast for gradients and secondary text; adjust if any combinations fail WCAG AA.

## Navigation & Menus (High)
- Consolidate the burger menu logic into a single module (e.g., `assets/js/burger.js`) and remove legacy mobile menu variables still present in `includes/header.php` JS.
- Move inline `<style>` blocks for the menu scrollbar and layout into `assets/css/input.css` to keep markup clean.
- Add focus trap, body scroll lock, and navbar hide/show with a single source of truth; avoid querying multiple selectors on open/close.
- Ensure language switcher buttons animate in (already started) and degrade gracefully without JS.

## Performance (High)
- Update Browserslist (warning appears on build); add `autoprefixer` to the Tailwind build via PostCSS.
- Purge unused CSS (Tailwind content paths are set; verify no inline styles bypass the purge) and consider splitting critical CSS for above-the-fold content.
- Optimize images: convert hero/backgrounds to WebP/AVIF, add `loading="lazy"` and `fetchpriority` where appropriate, and serve responsive sizes.
- Defer non-critical JS (counters, parallax, particles); lazy-init on intersection to reduce main-thread work on mobile.
- Consider preloading only the fonts actually used, with `font-display: swap`, and remove redundant preconnects.

## Code Quality & Structure (Medium)
- Modularize `assets/js/main.js` (navigation, forms, animations, analytics) into separate files; bundle/minify with source maps for prod, unminified for dev.
- Replace inline event handlers in `includes/header.php` with delegated listeners; keep markup presentation-free.
- Extract repeated gradient/button styles into utility classes or Tailwind components to reduce duplication in `assets/css/input.css`.
- Add linting/formatting: ESLint (for JS), Stylelint (for CSS/Tailwind), Prettier; wire to `npm run lint`.
- Add lightweight unit tests for menu open/close logic and a couple of form validators; optionally add a small Cypress smoke test for nav and contact flow.

## SEO & Content (Medium)
- Ensure consistent canonical/hreflang tags on all localized pages; verify sitemap.xml and robots.txt are present and correct.
- Add structured data (Organization + LocalBusiness where relevant; BreadcrumbList for inner pages).
- Validate heading hierarchy (one H1 per page) and avoid embedding hero copy into the menu to prevent duplicate content.
- Make sure language switcher links use absolute localized URLs and are crawable.

## Security & Privacy (Medium)
- Add security headers: CSP (with hashes for inline scripts/styles), HSTS, X-Content-Type-Options, X-Frame-Options/SameSite.
- Audit any user input points (forms): ensure server-side validation, rate limiting, and spam protection (invisible reCAPTCHA or hCaptcha).
- Review DB access for prepared statements everywhere; keep secrets out of the repo via environment variables.

## DevOps & Build (Medium)
- Add a `.nvmrc`/`.tool-versions` with the Node version; document setup in README.
- Add a production build script that bundles JS (esbuild/rollup) alongside Tailwind, with hashing for cache busting.
- Consider a simple CI workflow (lint + build) to prevent regressions.

## Internationalization (Low)
- Audit translation keys: ensure every UI string (including menu, toggles, errors) has entries in all locale files.
- Add fallback language handling and guard against missing keys in PHP templates.

## Analytics & Consent (Low)
- Confirm GA/gtag events fire only after consent where required; add a minimal consent banner if you target regions with consent rules.

## Nice-to-haves (Optional)
- Add a small microinteraction to the burger button (icon morph) that respects reduced-motion.
- Add subtle entrance animation for the language buttons (implemented with `.lang-show`; keep it short and responsive-only).
- Provide a compact “quick actions” row in the menu (Call/Telegram/WhatsApp) for mobile-first conversions.

## Step-by-step workflow (practical)
1) Foundation & cleanup
   - Remove inline handlers and inline styles in the header; move styles to CSS and logic to a dedicated JS module for the burger.
   - Add focus trap + aria to the burger; verify Escape/overlay close; lock body scroll without layout shift.
   - Add visible focus states (CSS only) and ensure `prefers-reduced-motion` is respected globally.

2) Navigation hardening
   - Split burger logic into `assets/js/burger.js`; export open/close; use a single state source.
   - Add focus trap helper and scroll-lock helper; write 2–3 unit tests for open/close and link click closes.
   - Move scrollbar and menu styles from inline `<style>` to `assets/css/input.css`.

3) Performance pass
   - Add `autoprefixer` + update Browserslist; rerun build.
   - Image pass: convert hero/backgrounds to WebP/AVIF, add `loading="lazy"` and `fetchpriority`, set responsive sizes.
   - Defer non-critical JS (counters, parallax, particles) with intersection observers; guard with reduced-motion.
   - Purge CSS (Tailwind already configured) and check for inline style leaks; preload only necessary fonts with `font-display: swap`.

4) SEO & headers
   - Canonical + hreflang on all localized pages; validate sitemap/robots.
   - Add structured data: `Organization`, `LocalBusiness` (if relevant), `BreadcrumbList`.
   - Add security headers (CSP with hashes for inline), HSTS, X-Content-Type-Options, X-Frame-Options/SameSite.

5) Code quality & DevOps
   - Introduce ESLint/Stylelint/Prettier; add `npm run lint` and a simple CI (lint + build).
   - Modularize `assets/js/main.js` (nav/forms/animations/analytics) and bundle with esbuild/rollup (hashing for prod).
   - Add `.nvmrc` with Node version; document setup in README.

6) Internationalization & consent
   - Audit translation keys; ensure language switcher uses absolute localized URLs and has fallbacks.
   - Add minimal consent gate for analytics if required; fire events after consent.

## Quick design polish suggestions
- Burger menu: keep the current clean list; add a tiny stagger fade/slide for list items (respect reduced-motion). Keep the language buttons with the new fade-in; limit duration to ~200ms.
- Buttons/links: unify gradient primary, outline secondary, and neutral ghost styles as utilities; consistent padding and corner radius.
- Focus states: use visible outlines or underlines, not only color changes; ensure contrast on both themes.
- Microinteraction: optional burger icon morph with `prefers-reduced-motion` guard.

