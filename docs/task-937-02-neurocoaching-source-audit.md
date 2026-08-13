# TASK-QUEUE-SUYAZOV_NEUROCOACHING.SY3.RU-937-02 source audit

## Source gate

- `3_Neurocoaching_1440.psd`: SHA-256 `932afd5dfe614e91b90890ea45d7d4f77bed73f4f20a08cf6ce7e71827a45aba`, verified after extraction from the Bridge-provided archive.
- `3_Neurocoaching_320.psd`: SHA-256 `2f9b1207fc4d92a604a6fa257f4a30837bdeae9149259e12028dc73f26aeabed`, verified after extraction from the Bridge-provided archive.
- The existing immutable layer manifest inventories 412 desktop and 312 mobile visible layers/groups, with 371 individual source assets and zero export errors. No full-page raster is used by the theme.

## Complete visible composition audit

The PSD layer inventory was checked against `page-neurocoaching.php`, the route-scoped rules in `style.css`, `neurocoaching_header()`, the gallery helper, and `navigation.js`. The mapped visible sections cover hero, Education & Experience, credentials, differentiation/brain process, Services | Neurointegration, personal story, method/science, suitability, Reviews, In real life/gallery, CTA, and FAQs. Copy, section order, typography families, route palette, measured desktop/mobile bounds, individual photos, diagrams, certificates, separators, arrows, checks, cards, and gallery controls remain represented by semantic HTML/CSS and individual source assets.

The objective mismatch found in this pass was the shared fallback header artwork on the Neurocoaching route. It is corrected with the exact desktop/mobile PSD logo and three social exports, plus the mobile PSD burger. Link destinations remain editable WordPress Customizer values. Other routes are unchanged.

## Browser QA

Fresh no-cache Chromium checks were run at 1440, 320, 390, 510, and 768 CSS pixels. At every viewport: the required heading is visible, `Internal Server Error` is absent, `scrollWidth === clientWidth`, all images load, console errors are zero, the menu opens/closes, FAQ details open, review keyboard-track wiring is present, and every CTA has a resolved destination. The default gallery contains one configured slide, so its next control is correctly disabled; the existing helper enables previous/next, dots, keyboard, and swipe when additional Customizer URLs are supplied.

The immutable 390×844 baseline remains unchanged. A fresh 390px candidate measured `0.489151` differing pixels with 15% colour fuzz against the baseline, above the required `0.15`. The mismatch is concentrated in the already-serialized hero rather than this 53px header correction. Replacing the current source-faithful/high-quality hero with the visibly degraded baseline would conflict with the PSD/source-first and responsive-image-quality requirements, so no such regression was made.

Production and deployment were not touched.
