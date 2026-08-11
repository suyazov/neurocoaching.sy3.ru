# Cross-route source-fidelity regression

Task: `TASK-QUEUE-SUYAZOV_NEUROCOACHING.SY3.RU-819-03`

This bounded pass compares `/`, `/career-services/`, and `/neurocoaching/` after the career and neurocoaching source reconstructions. The source of truth was the three checked-in page manifests and the verified PSD identities recorded by those manifests.

## Result

- Shared header, navigation, logo/social assets, typography, gutters, buttons, FAQ disclosure behavior, reviews, galleries, and the 850 px responsive boundary remain route-scoped and source-derived.
- The career gallery now participates in the same keyboard/touch carousel controller as the other routes. Its only usable PSD photo remains a responsive `<picture>` using the original desktop and mobile layer exports; its previous/next controls correctly remain disabled while only one slide exists.
- Required visible acceptance copy remains semantic DOM text in the three PHP templates. `Internal Server Error` is absent from all three templates.
- Templates reference individual source exports only. None references the page-sized background exports inventoried in the manifests, and no page screenshot is used as layout or text.
- Native `<details>/<summary>` FAQ controls and review/gallery controls remain operable without replacing visible text with raster content.
- Production and deployment configuration were not touched.

## Source identities

- About: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`
- Career desktop: `2_Career_1440.psd`, SHA-256 `b2868635078207e8768672971c85fc012e0bd00970b8867f7851f8ad6e0a101e`
- Career mobile: `2_Career_320.psd`, SHA-256 `df5e94607b68bbb94c11edbde761c6213b1e69b6e1c5463fe23c9fb7160eb2db`
- Neurocoaching desktop: `3_Neurocoaching_1440.psd`, SHA-256 `932afd5dfe614e91b90890ea45d7d4f77bed73f4f20a08cf6ce7e71827a45aba`
- Neurocoaching mobile: `3_Neurocoaching_320.psd`, SHA-256 `2f9b1207fc4d92a604a6fa257f4a30837bdeae9149259e12028dc73f26aeabed`
