# Project Context

## Identity

- Project: Digital Belka — Neurocoaching
- Domain: neurocoaching.sy3.ru
- Type: website
- Stack: WordPress, PHP, HTML/CSS, JavaScript
- Requested capability profile: wordpress-staging (onboarding intent only)
- Active capability profile: wordpress-staging (owner-authorized direct theme maintenance on staging)
- Default task kind: documentation
- Environment identity: neurocoaching.sy3.ru-staging (provisioned, live at https://neurocoaching.sy3.ru/)
- Production: false

## State

Staging WordPress site is live at https://neurocoaching.sy3.ru/ with the `neurocoaching` theme active. Direct theme maintenance uses scoped branches, reviewable pull requests, staging delivery to `/var/www/neurocoaching.sy3.ru`, and browser verification per AGENTS.md. Production, DNS, secrets, WordPress core/plugins/database, and destructive operations remain prohibited.

## Latest task outcome (TASK-INTENT-4970DF201266F84F, Bridge R7 Acceptance B retry)

- Added the exact marker `BRIDGE_R7_B3_OK` as a semantically inert HTML comment to the staging home page template `wordpress/wp-content/themes/neurocoaching/front-page.php` (no user-visible change).
- Added focused regression `acceptance/visual/bridge-r7-b3-marker-check.sh`: static check that the marker comment is present in the template; `--live URL` mode verifies the marker renders in the home page HTML and that `Fatal error` is absent.
- Verification: `php -l` on the changed PHP file, `git diff --check`, and the static regression check all pass; live staging verification recorded in the pull request.
