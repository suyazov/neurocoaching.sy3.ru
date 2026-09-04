# Agent scope

- Read the current canonical regulation before work: `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/1. Архитектура AFFiNE GitHub Bridge.md`.
- Current capability includes direct WordPress application-code maintenance explicitly authorized by the project owner.
- Direct maintenance uses a scoped `codex/*` branch, reviewable pull request, staging delivery, and browser verification; Bridge orchestration is not required when the owner explicitly requests direct work.
- Theme delivery must not preserve the repository's group-only directory permissions. Use a sync mode that does not copy owner/group/permissions, or restore public theme directories to `0755` and files to `0644`, then confirm the PHP-FPM `www-data` user can read the templates.
- Direct staging deploy/publish to `/var/www/neurocoaching.sy3.ru` is explicitly authorized by the project owner for this project.
- Production is `https://digitalbelka.com`. On 2026-09-01 the owner explicitly authorized the exact migration through WordPress admin only; no SSH access was required. Production theme delivery uses a public-readable runtime ZIP (`0755` directories, `0644` files), keeps OceanWP installed as the immediate rollback theme, and must be preceded by a fresh All-in-One WP Migration backup.
- Do not change production DNS, WP core/plugins/database, credentials, secrets, or unrelated production environments without a separate exact owner request. Never update the custom `Neurocoaching` theme from WordPress.org; its `Update URI` header prevents same-slug replacement.
- Never store raw secrets in this repository.
- Use controlled `codex/*` branches and pull requests.

## Protected shared components

- Latest direct production release: `1.0.20` (2026-09-04). Native PSD comparisons, later-client-overrides and unresolved source conflicts are recorded in `docs/qa/full-mobile-20260904/README.md`; do not describe this as unconditional 100% PSD equivalence.
- `page-privacy-policy.php` only renders the existing WordPress legal content. Do not move or rewrite that content into the theme as part of visual maintenance.

- `/`, `/career-services/`, and `/neurocoaching/` use one shared header and canonical `Education & Experience`, credentials, `In real life`, CTA, and FAQ components.
- Shared content geometry and responsive behaviour live in the `site-*` component layer in `style.css`; route classes are content-specific modifiers only.
- Refactoring and PSD-specific responsive corrections must not fork, duplicate, or override these shared components per route.
