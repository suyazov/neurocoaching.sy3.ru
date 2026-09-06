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

- Latest direct production release: `1.0.23` (2026-09-06): fresh 29-block PSD/mobile acceptance at 320/375/390/430; corrected Career suitable-title wrapping, premium button colour, review divider/link/expanded spacing and Neuro review header colours/link wrapping. All six expanded Career reviews pass on all four widths in Chrome and WebKit. Keep Corporate-reference pricing typography 16/20, Career Flagship 32px, shared gallery 10/62 gaps. Full report, production evidence and remaining source conflicts: `docs/qa/mobile-acceptance-20260906/README.md`. Do not describe this as unconditional 100% PSD equivalence. Fresh backup before final delivery: `digitalbelka.com-20260906-053554-rtju4p.wpress`; published CSS SHA-256 `13b3075cd86b414cf070b09559ed3d69613824dce5f128c17d6597c0c99716bc`.
- `page-privacy-policy.php` only renders the existing WordPress legal content. Do not move or rewrite that content into the theme as part of visual maintenance.

- `/`, `/career-services/`, and `/neurocoaching/` use one shared header and canonical `Education & Experience`, credentials, `In real life`, CTA, and FAQ components.
- Shared content geometry and responsive behaviour live in the `site-*` component layer in `style.css`; route classes are content-specific modifiers only.
- Refactoring and PSD-specific responsive corrections must not fork, duplicate, or override these shared components per route.
