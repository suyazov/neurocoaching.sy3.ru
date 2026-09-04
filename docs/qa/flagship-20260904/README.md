# Career Flagship — 04.09.2026

Follow-up to the September 3 video, approximately 02:20–02:27. Its entire audio track was locally transcribed in the preceding read-only review. The remaining mandatory finding was the Career Accelerator Flagship height: 37px on the site versus the native PSD `flag copy 2` layer at 163×32px.

## Change

- Mobile ribbon height: **37 → 32px**.
- Top moved down **2.5px** to keep the same centre as `4 SESSIONS`: 80px at ≤360px; 87px at361–850px.
- Right edge, typography, red offer colours, other cards and desktop styling are unchanged.
- Theme **1.0.21**, [PR186](https://github.com/suyazov/neurocoaching.sy3.ru/pull/186).

## Delivery

- Full backup created and verified in WordPress: `digitalbelka.com-20260904-094039-60zg95.wpress`, **297.34MB**.
- Replaced only the custom Neurocoaching theme through WordPress admin. Active theme confirmed as Neurocoaching1.0.21; OceanWP retained for rollback.
- Production stylesheet HTTP200/version/hash read-back matches source.
- CSS SHA256: `ac61047271cb8913d0714f850d073ac13fd47e25e5710cd7dae3b36b357324a4`.
- Runtime ZIP SHA256: `e4c7c46ffeac2e5c1ca8ca3414d29b7b859fefe39e9c3da53ee3c74d42093d7f`.
- All362 packaged files match source; only style.css differs from the previous runtime package; ZIP integrity and `git diff --check` pass.

## Verification

Staging at320/375/390/430: height32px, centre delta0px, inner-right-border gap0px, no horizontal overflow. Desktop1440 relative card/ribbon/label geometry and fonts unchanged.

Anonymous published-site verification passes at all four widths: height32px, centre delta0px, right gap0px, no horizontal overflow. Desktop1440 relative geometry/fonts match the pre-change result. Measurements (`published-*.json`, `desktop-1440.json`) and [native320 screenshot](flag-320.png) are retained alongside this report. These checks are scoped to this correction, not a new full-site or physical Safari audit.

The video's remaining red-colour observation is explicitly waived by the client's «ну и ладно»; Career Special Offer stays `#f1264b`. No commercial content, prices, plugins, WordPress settings or DNS changed.
