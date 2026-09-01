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
