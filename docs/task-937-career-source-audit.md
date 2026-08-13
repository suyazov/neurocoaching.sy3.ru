# TASK-QUEUE-SUYAZOV_NEUROCOACHING.SY3.RU-937-01 source audit

The sole design sources were `2_Career_1440.psd` (`b2868635078207e8768672971c85fc012e0bd00970b8867f7851f8ad6e0a101e`) and `2_Career_320.psd` (`df5e94607b68bbb94c11edbde761c6213b1e69b6e1c5463fe23c9fb7160eb2db`). The checked-in complete layer inventory was reviewed section-by-section against the Career template, styles, responsive image sources, and interaction controller.

TASK-935 is serialized in `main` at `17c29ab80b36e770103f97e51b68226ef97cff99`. Its mobile hero photograph, mask, and photo-to-copy geometry were treated only as a regression gate and were not independently changed.

## Correction

The Career header was the remaining objective source mismatch: it used the shared logo/social rendering on mobile even though the Career PSD supplies dedicated 89×45 logo and 22×21/22 source exports. `neurocoaching_header()` now selects those source exports only for the Career route while retaining the shared editable URLs and semantic links. Desktop uses the Career PSD logo export; other routes are unchanged.

## Verified invariants

- `Stop postponing your life` remains exact semantic text.
- `Internal Server Error` is absent from the Career template.
- Navigation, burger, certificate track, credential jump, review expansion, gallery controls, and FAQ disclosures remain real controls managed by the existing controller.
- Responsive images remain source assets in semantic `<picture>` elements; no page raster was introduced.
- The 850 px dedicated-mobile boundary covers 320, 390, 510, and 768 widths; desktop remains the 1440 composition.
- WordPress Customizer URLs and gallery settings remain editable.
- Production, deployment configuration, uploads, database, credentials, and the immutable acceptance baseline were not changed.

## Visual-contract blocker

The immutable `acceptance/visual/career-mobile-390x844.png` has SHA-256 `7039c7cd431b44b017205cae3a7fb7fb806aa1ce3e698456843b4d8ebb0f626c`. A fresh no-cache 390×844 capture of serialized TASK-935 differs by 120,741 of 329,160 pixels at ImageMagick 15% fuzz (ratio `0.366814`, above `0.15`). Inspection shows that the baseline contains the pre-TASK-935 hero crop/photo-to-copy boundary, while the current source-faithful route contains the newly serialized TASK-935 2:3 portrait and geometry. Reverting that region would violate this task's explicit TASK-935 regression gate and the PSD layer bounds. The baseline was therefore preserved and the conflict is reported for orchestration-level baseline reconciliation.
