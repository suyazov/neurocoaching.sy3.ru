# Project Context

## Identity

- Project: Digital Belka — Neurocoaching
- Production domain: digitalbelka.com
- Staging domain: neurocoaching.sy3.ru
- Type: website
- Stack: WordPress, PHP, HTML/CSS, JavaScript
- Active capability profile: direct WordPress theme maintenance, staging, and owner-authorized production delivery
- Environment identity: `neurocoaching.sy3.ru` staging plus `digitalbelka.com` production
- Production: active

## State

- GitHub `main` is the source for the custom `Neurocoaching` theme; staging checkout is `/var/www/neurocoaching.sy3.ru`.
- Production was migrated through WordPress admin on 2026-09-01. The custom theme is installed separately and active; legacy OceanWP remains installed for immediate rollback.
- Published production routes: `/`, `/career-services/`, and `/neurocoaching/`.
- A fresh full All-in-One WP Migration backup was created immediately before migration. Raw WordPress credentials are not stored in the repository.
- Production runtime packaging excludes the large PSD/source export directories except the two pyramid images referenced by live templates. Theme directories/files must be `0755`/`0644`.
- Legacy Elementor Theme Builder header/footer templates remain available for OceanWP rollback and are hidden only by the active custom theme.
- 2026-09-01: Mobile `In real life` gallery spacing was aligned with the PSD on About, Career services, and Neurocoaching: `10px` from the image to pagination and `62px` from pagination to the following section at 320px and 390px viewports. Staging and production read-back confirmed the same geometry with no horizontal overflow (PR #171).
- 2026-09-02: Responsive audit fixes release fixed-width overflow in the Neurocoaching featured card, story, and method sections for 361–526px viewports, and keeps shared gallery photos plus both controls inside compact 851–1279px canvases (PR #172). Staging verification covered 320–600px Neurocoaching layouts, all three shared galleries at 320/390/900/1024px, control interaction, and unchanged 1440px geometry. Production delivery through WordPress admin followed a fresh 297.12 MB full backup; live CSS read-back matched `main`, and anonymous mobile/compact-browser QA passed without console errors or failed theme assets.
- 2026-09-03: Public theme templates stopped loading historical Elementor, Pro Elements, ElementsKit, and Google Fonts frontend bundles. All live page typography is served by the theme's local Lato and IBM Plex Sans files; Elementor preview/admin remain excluded from the cleanup. Staging mobile Slow 4G verification reduced the About route from 87 to 27 network requests and first contentful paint from about 4.0 s to 1.74 s, with About, Career services, Neurocoaching, the mobile menu, and certificate lightbox smoke-tested without horizontal overflow or runtime errors. Production theme `1.0.14` was delivered through WordPress admin after full backup `digitalbelka.com-20260903-120936-ecdf3i.wpress` (297 MB). Anonymous production mobile Slow 4G verification reported 33 requests, FCP 2.01 s, LCP 2.01 s, CLS 0, no external hosts, no console errors, and no horizontal overflow on About, Career services, or Neurocoaching; OceanWP remains installed for rollback.
- 2026-09-03: Production theme `1.0.15` normalizes every mobile service-card title, section heading, and ribbon/callout to an interpreted `IBM Plex Sans` 18/22 px treatment across About, Career services, and Neurocoaching (PR #178). A fresh full backup `digitalbelka.com-20260903-124704-4hcmm8.wpress` (297 MB) was created immediately before the WordPress-admin replacement. Anonymous production QA at 320px and 390px confirmed identical computed typography, all targets inside their card boundaries, no horizontal overflow, and no console warnings/errors; Neurocoaching remains active and OceanWP remains installed for rollback.
- 2026-09-03: Exact follow-up comparison against the retained PSD layer manifests found that the uniform `18/22px` mobile service-heading rule in theme `1.0.15` is not source-faithful: the PSD uses separate sizes for page section titles, card titles, `Includes`/`Programmes`, ribbons, and small labels. It also confirmed open Neurocoaching desktop height drift (`960px` live hero versus `909px` PSD, plus an oversized Reviews section). No production mutation was made during this audit. The bounded correction list and already-verified exclusions are recorded in `docs/qa/production-psd-gap-list-2026-09-03.md`.
