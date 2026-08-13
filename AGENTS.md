# Agent scope

- Read the current canonical regulation before work: `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/1. Архитектура AFFiNE GitHub Bridge.md`.
- Current capability includes direct WordPress application-code maintenance explicitly authorized by the project owner.
- Direct maintenance uses a scoped `codex/*` branch, reviewable pull request, staging delivery, and browser verification; Bridge orchestration is not required when the owner explicitly requests direct work.
- Do not configure DNS, deploy, publish, or touch production.
- Never store raw secrets in this repository.
- Use controlled `codex/*` branches and pull requests.

## Protected shared components

- `/`, `/career-services/`, and `/neurocoaching/` use one shared header and one canonical `In real life` component.
- Refactoring and PSD-specific responsive corrections must not fork, duplicate, or override these shared components per route.
