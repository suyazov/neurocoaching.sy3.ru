# Server cleanup / recovery — 2026-09-14

## Follow-up completed

All nine linked worktrees removed successfully. Owner then approved private source storage: `https://github.com/suyazov/neurocoaching-private-archive`, release `sources-20260914`. Fifteen positively identified original files (940,079,178 bytes) archived with individual SHA-256 manifest. Release was downloaded again, archive SHA matched, tar listing passed and each original hash revalidated before source deletion. Temporary archive copies removed. Latest Neuro PSD and September3 video are now recoverable from that private release, not the historical local paths below. Ambiguous attachments and unlocated About/Career original PSD remain unresolved; do not claim full source coverage. Primary checkout, staging and credentials retained.

Owner requested preservation followed by removal of local project copies; credentials must remain.

## Recovery source

- Repository: https://github.com/suyazov/neurocoaching.sy3.ru
- Verified remote tag: `archive/production-1.0.28-20260914`
- Commit: `6f3701ceeda1d839c0ccb808ca49d8dfd05743d1`
- Contains the latest delivered theme 1.0.28, project context and QA reports through September 11.
- Main has subsequent portfolio work but still theme 1.0.20. PRs186–192 remain open; do not restore the live theme from main until integration is completed.
- Recovery: clone repository, checkout the archive tag. Runtime deployment excludes PSD/source exports and requires separate authorization and normal production safety checks.

## Cleanup boundary

Nine clean linked worktrees are approved for removal. Before removal all ten registered copies had no dirty/untracked/ignored files and no commits outside locally recorded remote refs. Remote archive-tag SHA was independently read back.
Keep the primary checkout `/opt/projects/neurocoaching.sy3.ru`, staging `/var/www/neurocoaching.sy3.ru`, original attachments, and production untouched at this stage.

## Not yet archived off-server

Original PSD/video files are not tracked in the public repository. Neuro PSD remains at `/root/.codex/attachments/16816170-6085-482c-87b5-cfb74b22d0c3/3_Neurocoaching_320_31 августа.psd`. Historical extracted About PSD path `/tmp/belka-psd-audit.p1Kd7d/sources/1_About me_1320 и 320.psd` no longer exists. Original archive location and private storage destination still need confirmation before attachment cleanup. Do not delete original attachments or claim complete source archival.

## Access retained

Production WordPress access: `/root/.config/client-access/digitalbelka/wordpress.env`; file0600, parent0700 verified. No raw credentials copied into Git. Staging decommission is not included.
