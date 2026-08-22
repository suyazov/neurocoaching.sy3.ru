# Final block-by-block PSD audit — 2026-08-22

Source of truth: the latest customer PSD files in `source/`, supplemented only by the customer's later explicit PDF/image corrections. The three routes use shared components where the content pattern is shared; route modifiers preserve the measured PSD geometry.

## Fresh production re-audit after owner review

All six target screens were rendered again from the latest PSD files and compared side by side with fresh production full-page captures at the native source widths. This pass did not reuse the old screenshots as the source of truth.

| Route | PSD desktop | Live desktop | PSD mobile | Live mobile | Horizontal overflow |
|---|---:|---:|---:|---:|---:|
| About | 1320×6101* | 1320×5555 | 320×5753 | 320×5801 | 0 px |
| Career Services | 1440×9212 | 1440×9153 | 320×9307 | 320×9342 | 0 px |
| Neurocoaching | 1440×10926 | 1440×10935 | 320×11553 | 320×11566 | 0 px |

`*` The About PSD canvas contains material below the actual 5671 px page composition; it is not implemented as page content.

Confirmed corrections from this re-audit:

- About desktop CTA content now uses the PSD coordinates: title `x=197/y=3858`, subtitle `x=196/y=3942`, button `x=195/y=3989`, section height `401px`.
- About mobile B2B `Book a call` is filled `#855CAC` with white text, matching the mobile PSD instead of inheriting the shared outline-button rule.
- About desktop hero now selects the 768 px source candidate for the measured 711 px rendered image instead of stretching the 512 px candidate; the crop and layout are unchanged.

Functional differences that intentionally supersede decorative PSD pixels remain limited to the customer-approved certificate sets, the real functional gallery-dot count, the later supplied About FAQ photograph, and the consistent NeuroSprint price described below.

## Shared components

- **Header:** one semantic structure, one logo/social icon set, common navigation spacing and active state on all three routes.
- **Education & Experience:** common preview frame, `View more` control, supplied white gallery arrow, keyboard scrolling and certificate lightbox.
- **Credentials:** common two-column desktop and stacked mobile structure using the supplied violet check icon.
- **In real life:** one carousel component, common typography, Instagram treatment, arrow controls and pagination. Pagination count follows real slide count rather than the decorative dot count in the PSD.
- **CTA and FAQ:** common typography, buttons, disclosure controls and right-hand booking panel. Route copy and photography remain independent.

## About (`/`)

- Hero/header: aligned to the 1320 px artboard; desktop hero height `852px`.
- Education: starts at `y=852`, height `481px`; eight certificates available in the viewer.
- Credentials: starts at `y=1333`, height `553px`.
- Services / B2B: starts at `y=1886`; shared card geometry retained.
- In real life: starts at `y=2768`, height `944px`; visible image `674×479`; three real slides and three functional pagination dots.
- CTA: starts at `y=3708`, height `401px`.
- FAQ: starts at `y=4109`; uses the customer's later jumping-photo correction, which supersedes the older seated-photo PSD layer.

## Career Services (`/career-services/`)

- Hero/header: desktop hero height `1139px`.
- Education: `y=1139`, height `473px`; same eight-certificate set as About.
- Credentials: `y=1612`, height `472px`.
- Positioning: `x=107`, `y=2084`, `1226×727`; divider, copy column, checks and `236px` CTA button aligned to the PSD grid.
- Pricing: shared card foundations with Career-specific content; consultation and accelerator cards preserve PSD sizes, flags, zigzags, checkmarks, price hierarchy and offer ribbons.
- Suitable / Reviews: section boundaries `y=4419` and `y=5233`; horizontal review track has no visible scrollbar.
- In real life: `y=6209`, height `1105px`; visible portrait `512×632`; four slides and four functional dots.
- CTA / FAQ: `y=7311` and `y=7707`; Career photo and button copy remain route-specific.

## Neurocoaching (`/neurocoaching/`)

- Hero/header: desktop hero height `909px`.
- Education: `y=909`, height `474px`; independent five-certificate set.
- Credentials: `y=1383`, height `502px`.
- Difference: `x=110`, `y=1885`, `1220×655`.
- Pricing: service section starts at `y=2682`; cards preserve the desktop PSD geometry, flags, separators, prices and buttons.
- Story / Method / Suitable: boundaries at `y=4653`, `y=5719`, and `y=6447`.
- Reviews: starts at `y=7195` (subpixel measured `7194.7`), height `741px`.
- In real life: starts at `y=7932` (subpixel measured `7931.7`), height `1106px`; visible image `961×632`; four slides and four functional dots.
- CTA / FAQ: `y=9035` and `y=9431`; FAQ now uses the mountain photograph exported from the Neuro PSD instead of the incorrect About photograph.

## Responsive and functional checks

- Tested desktop source widths: About `1320`, Career/Neuro `1440`.
- Tested mobile source width: `320` for all routes.
- No horizontal overflow at desktop or mobile widths.
- Gallery next controls change the active slide and load a non-zero natural-size source image.
- Certificate counts: About `8`, Career `8`, Neuro `5`; lightbox opens and next/close controls work.
- FAQ disclosures change state on click.
- No browser console errors and no HTTP responses `>=400` during the functional smoke test.

## Explicit source conflict

The Neuro price differs between the supplied desktop and older mobile artwork (`350 €` versus `150 €`). The implementation keeps `350 €` consistently on desktop and mobile so the same product cannot show two contradictory prices. This is a deliberate content-safety exception to literal mobile raster matching.
