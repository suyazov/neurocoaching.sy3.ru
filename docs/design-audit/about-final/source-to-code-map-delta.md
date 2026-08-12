# About source-to-code map delta

Source identity: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`.

| Source area | Semantic implementation | Final delta |
|---|---|---|
| Header + hero | `front-page.php`, `neurocoaching_header()`, `.site-header`, `.nc-about__hero` | Geometry and content retained; fresh audit found no material structural delta. |
| Education & Experience | `.nc-about__education`, certificate figures and editable theme assets | PSD band, title, five certificates and source spacing retained. |
| Credentials | `#nc-about-credentials` semantic list | Two-column desktop and single-column mobile source order retained. |
| Services \| B2B format | `.nc-about__services`, `.nc-about__service-card` | Restored the PSD lavender card field (`#c8d2fa`) instead of white. |
| In real life | `neurocoaching_gallery()`, buttons, slides and pagination | Restored exact square 86×86 source arrow assets and the full source dot line while keeping functional carousel controls and WordPress-editable slide URLs. |
| Mobile artboard | Existing semantic About DOM | Scales the complete 320 px source composition to the dedicated mobile viewport, eliminating the unscaled 320 px column at 390 px. |
| Following CTA | `.nc-about__cta` | PSD 401/250 px source heights, heading, copy and Book a call retained. |
| FAQs | semantic `<details>` rows and editable CTA links | Desktop two-column and mobile stacked composition retained; no raster flattening introduced. |

No immutable acceptance baseline, WordPress data, upload, plugin, core file, server configuration, or external environment was changed.
