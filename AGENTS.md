# Agent scope

- Read the current canonical regulation before work: `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/1. Архитектура AFFiNE GitHub Bridge.md`.
- Current capability is docs-only and `default_task_kind=documentation`.
- Do not create application code or an executable product TASK during onboarding.
- Do not configure DNS, deploy, publish, or touch production.
- Never store raw secrets in this repository.
- Use controlled `codex/*` branches and pull requests.

## Current visual system

- `/`, `/career-services/`, and `/neurocoaching/` share the Digital Belka cross-route design-system layer at the end of `wordpress/wp-content/themes/neurocoaching/style.css`.
- Keep the shared header geometry, 1220 px desktop grid, typography scale, purple/paper palette, buttons, cards, CTA, FAQ rhythm, and 60 px mobile header consistent across all three routes.
- Route-specific PSD composition may remain inside individual sections, but must not reintroduce a separate site-wide header, palette, component language, or breakpoint system.
