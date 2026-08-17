# Agent scope

- Read the current canonical regulation before work: `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/1. Архитектура AFFiNE GitHub Bridge.md`.
- Current capability includes direct WordPress application-code maintenance explicitly authorized by the project owner.
- Direct maintenance uses a scoped `codex/*` branch, reviewable pull request, staging delivery, and browser verification; Bridge orchestration is not required when the owner explicitly requests direct work.
- Theme delivery must not preserve the repository's group-only directory permissions. Use a sync mode that does not copy owner/group/permissions, or restore public theme directories to `0755` and files to `0644`, then confirm the PHP-FPM `www-data` user can read the templates.
- Do not configure DNS, deploy, publish, or touch production.
- Never store raw secrets in this repository.
- Use controlled `codex/*` branches and pull requests.

## Protected shared components

- `/`, `/career-services/`, and `/neurocoaching/` use one shared header and canonical `Education & Experience`, credentials, `In real life`, CTA, and FAQ components.
- Shared content geometry and responsive behaviour live in the `site-*` component layer in `style.css`; route classes are content-specific modifiers only.
- Refactoring and PSD-specific responsive corrections must not fork, duplicate, or override these shared components per route.
