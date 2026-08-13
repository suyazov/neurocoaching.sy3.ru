# TASK-933 About mobile header QA

Source of truth: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`. Measurements were re-read for generation G2 from the visible `Tablet 320 px / menu burger` layer tree. Layer metadata was inspected without rendering the full PSD.

## PSD 320 bounds

Coordinates are relative to the 320 artboard (the PSD artboard origin is x=10143).

| Element | PSD bounds (x, y, w, h) | Browser 320 bounds | Result |
| --- | --- | --- | --- |
| Purple background | -1, -1, 323, 54 | 0, 0, 320, 53 | Exact visible artboard coverage |
| Digital Belka logo | 16, 4, 89, 45 | 16, 4, 89, 45 | Exact |
| LinkedIn | 145, 15, 22, 21 | 145, 15, 22, 21 | Exact |
| Instagram | 180, 16, 22, 21 | 180, 16, 22, 21 | Exact |
| Telegram | 213, 15, 22, 22 | 213, 15, 22, 22 | Exact |
| Burger | 281, 16, 24, 22 | 281, 16, 24, 22 | Exact |
| Hero photo layer | 0, 50, 320, 405 | 0, 50, 320, 405 | Exact; header overlays its first 3 px |

The PSD z-order puts the purple background above the photo from y=50 through y=53, so the photo layer begins at y=50 and becomes visible immediately below the 53 px header.

## Responsive browser readback

At 320, 390, 510 and 768 CSS px the header is 53 px high with zero padding and `rgb(133, 92, 172)` background. Logo and social controls retain the source dimensions and coordinates; the burger retains 24×22 and stays 15 px from the right edge. The hero photo layer begins at y=50 at every tested width.

All four runs recorded:

- burger `aria-expanded`: false → true → false, and the menu display becomes `flex`;
- real brand, LinkedIn, Instagram and Telegram anchors receive click events and have non-empty URLs;
- `scrollWidth == clientWidth`;
- console/page errors: 0;
- `Ksenia Belousova` visible;
- `Internal Server Error` absent.

Natural and rendered image dimensions, complete computed styles and element bounds are in `browser-metrics.json`. Fresh no-cache first-viewport screenshots from the persistently delivered G2 staging build are stored beside this report. The G2 implementation adds intrinsic `width`/`height` hints in semantic markup and min/max/flex guards in mobile CSS, preventing generic responsive rules from enlarging or collapsing the source-sized controls.

The machine guard is `php docs/qa/TASK-ISSUE-SUYAZOV_NEUROCOACHING.SY3.RU-933/verify-regression.php`; it verifies the four required controls, PSD asset dimensions, fixed bounds and hero boundary.

## Frozen baseline conflict

The unmodified `acceptance/visual/about-mobile-390x844.png` represents the rejected scaled header with an approximately 61 px header/hero offset. The immutable Bridge receipt records `0.0516381`, above the frozen `0.04` threshold, for the same deterministic PSD-correct 390 screenshot SHA-256 `56bd7e41ecf2555205cfea8da5a4c61236f885b3359cb3875cef928a86cf01cc`. Per the task's explicit precedence rule, that conflicting acceptance PNG was not used to restore the rejected scaling and was not modified.
