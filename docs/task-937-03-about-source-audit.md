# TASK-QUEUE-SUYAZOV_NEUROCOACHING.SY3.RU-937-03 — About source audit

The original `1_About me_1320 и 320.psd` archive member was verified at SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`. Its embedded desktop/mobile artboards and layer bounds were inspected without full-document compositing.

The source map covers the About hero, Education & Experience certificates, credential list, Services | B2B card and decorations, In real life gallery, CTA, and FAQ/sidebar. The existing section geometry, copy, type families, measured palette, responsive source assets, and controls already match the PSD reconstruction retained on `main`. The exact mobile header and header-to-hero boundary from TASK-933 were treated as protected: `header.php` and the accepted header rules were not changed.

Two objective defects outside that protected scope were corrected:

- hero imagery now uses `object-fit: cover`, preserving natural source proportions at every responsive box while retaining the measured crop and bounds;
- the default About carousel now contains three distinct, locally available Ksenia photographs instead of three duplicate URLs. The PSD life image remains slide one, so source geometry and the frozen first viewport remain unchanged. All three defaults remain editable as newline-separated WordPress Customizer URLs.

The existing controller supplies previous/next, pagination, keyboard, touch swipe, and correct active-slide state. Responsive rules bound page and galleries to the viewport at 320, 390, 510, and 768 CSS pixels and preserve the 1320 artboard geometry at desktop/1440. No acceptance baseline, upload, database, production, deployment, or external service was changed.
