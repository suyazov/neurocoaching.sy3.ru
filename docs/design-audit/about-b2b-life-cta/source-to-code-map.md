# TASK-913 source-to-code map

Source of truth: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`. Measurements are artboard-relative pixels from the complete PSD layer tree. Browser values are a fresh no-cache staging readback at 1320 and 320 CSS px on 2026-08-12.

## Source mapping

| PSD group/layers | Semantic implementation | Reconstruction decision |
|---|---|---|
| Desktop/Tablet `Block 4`, `Headline`, `Background`, `Programmes`, `Button` | `front-page.php` `.nc-about__services`; `style.css` service selectors | Dedicated 1037×597 / 295×727 card geometry, source fill and stroke, independent desktop/mobile typography and positions. B2B button has its own filled style. |
| Desktop/Tablet `Block 5`, `Headline`, `instagram copy`, `Image`, `Arrow 1/2`, `Circles Gallery` | `neurocoaching_gallery()`, `navigation.js`, `.nc-about__life*`, `.nc-gallery*` | The source slider shell remains present for one real slide, with disabled source arrows and no invented dots. Additional configured URLs automatically produce real slides and dynamic controls/dots. |
| Desktop/Tablet `Block 6`, `Number copy 3`, subtitle, `Button` | `.nc-about__cta`, `.nc-about__cta-button` | Section-specific cream fill/dark-purple text replaces inherited transparent CTA styling. Desktop and mobile use independent source bounds. |

The PSD and repository contain one legitimate About photo (`about-life-source.webp`). No photo was duplicated or invented. The functional fixture used the existing legitimate project assets `career-life.webp` and `neuro-life.webp`; it did not alter WordPress settings or persist fixture content.

## Numeric source vs browser bounds

Coordinates for children are relative to their section; card coordinates are relative to the viewport where the PSD explicitly supplies them.

| Element | PSD desktop | Browser desktop | PSD mobile | Browser mobile |
|---|---:|---:|---:|---:|
| Services heading | x=352 y=0 w=660 h=59 | x=352.12 y=0 w=615.75 h=59.8 | x=15 y=0 w=190 h=68 | x=15 y=0 w=220 h=84 |
| Service card | x=146 y=139 w=1037 h=597 | x=141.5 y=139.8 w=1037 h=597 | x=12 y=108 w=295 h=727 | x=12 y=108 w=295 h=727 |
| Team Workshops | x=195 y=198 w=235 h=90 | source-positioned in card | x=39 y=134 w=104 h=42 | source-positioned in card |
| Corporate ribbon | x=408 y=195 w=158 h=34 | 158×34 source asset | x=146 y=198 w=158 h=34 | 158×34 source asset |
| Divider | x=194 y=426 w=374 h=6 | 374×6 | x=37 y=236 w=246 h=6 | 246×6 |
| Life section | x=0 y=0 w=1320 h=944 | x=0 y=0 w=1320 h=944 | x=-1 y=0 w=323 h=340 PSD content; implementation band h=434 | x=0 y=0 w=320 h=434 |
| Life heading | x=525 y=152 w=309 h=50 | y=143 h=65 line box | x=73 y=0 w=172 h=27 | y=28 h=36 line box |
| Instagram icon | x=778 y=236 w=28 h=29 | 29×29 | x=231 y=45 w=21 h=21 | 21×21 |
| Life image viewport | x=324 y=314 w=674 h=479 | x=323 y=311 w=674 h=479 | x=-1 y=81 w=323 h=223 | x=-1 y=116.8 w=323 h=223 |
| Previous / next | x=192/1042 y=512 w=86 h=86 | x=192/1042 y=507.5 w=86 h=86 | not present in 320 artboard | hidden at mobile breakpoint |
| CTA section | x=0 y=0 w=1320 h=401 | x=0 y=0 w=1320 h=401 | x=-1 y=0 w=323 h=250 | x=0 y=0 w=320 h=250 |
| CTA heading | x=197 y=150 w=654 h=48 | x=195 y=150 w=930 h=48 | x=15 y=37 w=233 h=74 | x=15 y=37 w=277 h=80 line box |
| CTA subtitle | x=196 y=234 w=311 h=13 | x=196 y=234 w=929 h=18 line box | x=16 y=128 w=276 h=11 | x=16 y=128 w=289 h=16 line box |
| CTA button | x=195 y=281 w=186 h=63 | x=195 y=281 w=186 h=63 | x=15 y=162 w=183 h=53 | x=15 y=162 w=183 h=53 |

Text-layer widths differ where the browser reports the containing line box rather than painted glyph bounds; the positional, font-size, line-height, wrap and fixed geometry contracts are mapped independently.

## CTA computed readback

| Viewport | Fill | Text | Border | Computed size |
|---|---|---|---|---|
| 1320 | `rgb(248, 241, 238)` (`#f8f1ee`) | `rgb(63, 41, 97)` (`#3f2961`) | `1px solid rgb(248, 241, 238)` | 186×63 |
| 320 | `rgb(248, 241, 238)` (`#f8f1ee`) | `rgb(63, 41, 97)` (`#3f2961`) | `1px solid rgb(248, 241, 238)` | 183×53 |

## Slider functional QA receipt

- Truthful current state: `data-slide-count="1"`; previous and next remain visible on desktop and are natively disabled with `aria-disabled=true`; dot count is 0; the semantic carousel shell remains present.
- Legitimate three-slide fixture: existing About photo plus `career-life.webp` and `neuro-life.webp`.
- Active sequence for next, previous, dot 2, Home, End, ArrowLeft, swipe-left: `0 → 1 → 0 → 2 → 0 → 2 → 1 → 2` (pass).
- Dynamic dots, active state, mouse controls, Left/Right/Home/End and touch swipe passed.
- Desktop and mobile console errors: 0. Horizontal overflow: 0 px.
- Machine-readable receipt: `browser-qa.json`.

## Visual evidence

Fresh candidate and source crops are in `crops/` for `services`, `life`, and `cta`, independently at desktop and mobile sizes. Source crops are derived only from the verified PSD preview; candidate crops are fresh staging element screenshots after delivery.
