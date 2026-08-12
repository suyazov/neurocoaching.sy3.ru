# TASK-916 G2 source-to-code map

Sole source: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`. The existing complete map in `docs/task-916/source-to-code-map.md` remains canonical; this delta records the rejected runtime gaps corrected in G2.

| PSD element | Source bounds | Runtime mapping / final browser bounds |
|---|---:|---|
| Mobile hero image mask | `0,50,320×405` | PSD-derived `about-hero-mobile-source.webp` selected by semantic `<picture>`; browser `0,50,320×405` |
| Mobile hero CTA | `15,1306,185×55` | `.nc-about__hero-copy > .nc-about__button`; browser exact `15,1306,185×55`, no Education overlap |
| Mobile hero / Education boundary | `y=1391` | corrected bounded interpolation; browser exact `y=1391` at 320 and `y=1442` at 390 |
| Mobile B2B card | `15,2473,290×727` | independently centred card; browser exact at 320 and `x=50,width=290` at 390 |
| Mobile In real life image / dots | source image `0,3331,320×223`, pagination at `y=3554` | viewport-bounded centred gallery; exactly three real DOM slides/dots, editable URLs normalised to three |
| Mobile CTA | `0,3634,320×250` | independent 290 px inner composition; browser section exact at 320 and centred at 390 |
| Mobile FAQ | `15,3884,290px` | independent 290 px composition; `x=15` at 320, `x=50` at 390 |
| Mobile FAQ sidebar CTA | `15,5491,186×53` | dedicated borderless violet/white button, browser exact bounds and computed styles |
| Desktop FAQ/sidebar | question grid `663px`, sidebar image `290×375`, CTA `293×63` | dedicated two-column grid preserved; separator corrected to source `6px`; CTA `293×63`, padding `0`, border `0`, violet fill, white 18px text |

All other visible mobile elements remain mapped in the canonical TASK-916 map. The implementation remains semantic HTML; no whole-page raster, canvas, giant SVG or duplicate UI was added.
