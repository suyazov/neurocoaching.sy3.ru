# Production vs PSD gap list — 2026-09-03

## Scope and source of truth

- Production: `https://digitalbelka.com`, active custom theme `Neurocoaching 1.0.15`.
- Routes: `/`, `/career-services/`, `/neurocoaching/`.
- Live checks: native mobile width `320px`, additional mobile width `390px`, desktop source widths `1320px` for About and `1440px` for Career/Neurocoaching.
- PSD evidence retained in the repository:
  - `acceptance/visual/about-psd-layer-manifest.json`
  - `acceptance/visual/career-psd-layer-manifest.json`
  - `acceptance/visual/neurocoaching-psd-layer-manifest.json`
  - `acceptance/visual/final-block-audit-2026-08-22.md`
- Later explicit customer corrections override old PSD text or images where noted below.

The source files do **not** need to be sent again. The manifests contain the original PSD hashes, artboard geometry, text-layer coordinates and exported assets required for the remaining comparison.

## Open discrepancies

### P1 — Restore the mobile pricing-card typography hierarchy on all routes

Theme `1.0.15` added one global mobile rule that forces card titles, `Includes`/`Programmes`, and ribbons to the same `IBM Plex Sans 18/22px` style. That rule is internally consistent but is not faithful to the PSD hierarchy.

The remaining implementation must restore styles by semantic role instead of assigning one size to every element:

| Text role | PSD target at 320px | Current production |
|---|---:|---:|
| Services section title | about `36/40`, career `36/40`, neuro `36/40` | about/neuro `40/42`, career `34/35.7` |
| Product/card title | approximately `20/24` | `18/22` |
| Career/Neuro `Includes` | approximately `20/24` | `18/22` |
| About `Programmes` | `36/40` | `18/22` |
| Ribbons (`Corporate`, `Flagship`, free call, offer) | approximately `16/20` | `18/22` |
| Small uppercase labels | approximately `14/18–19` | already close; must remain separate from the rule above |

Important source conflict: the verbal request that every green-circled heading be literally the same size cannot simultaneously match the retained PSD. For example, the About PSD uses `Programmes` at about `36/40`, `Team Workshops` at about `20/20–24`, and `Corporate` at about `16/20`. Since final acceptance is defined as matching the PSD, the implementation target is the PSD role hierarchy, not one global value.

### P1 — About mobile: correct the B2B card type sizes without moving the section

The geometry is already close; this is primarily a typography issue.

| Element | PSD Y | Production Y | Position delta | Required change |
|---|---:|---:|---:|---|
| `Services | B2B format` | 2365 | 2362 | -3 | `40/42` → `36/40` |
| `Team Workshops` | 2499 | 2507 | +8 | `18/22` → PSD card-title size |
| `Corporate` | 2574 | 2570 | -4 | `18/22` → PSD ribbon size; retain attachment to card edge |
| `Programmes` | 2838 | 2845 | +7 | `18/22` → `36/40` |
| `In real life` | 3243 | 3256 | +13 | should settle after card typography correction |
| CTA title | 3671 | 3672 | +1 | no independent change |
| `FAQs` | 3941 | 3943 | +2 | no independent change |

### P1 — Career mobile: move the service composition back to its PSD origin and restore role sizes

The entire pricing composition is currently about `74–83px` below its PSD coordinates. This is a section-rhythm problem, not a separate offset error for every flag.

| Element | PSD Y | Production Y | Delta |
|---|---:|---:|---:|
| `Services | Career` | 3399 | 3482 | +83 |
| `Consultation Session` | 3531 | 3612 | +81 |
| First `Includes` | 3844 | 3926 | +82 |
| `Free 30-min intro call` | 3894 | 3968 | +74 |
| `Career Accelerator` | 4312 | 4393 | +81 |
| `Flagship` | 4376 | 4450 | +74 |
| Second `Includes` | 4625 | 4707 | +82 |
| `Special Offer` | 5046 | 5121 | +75 |

Required result:

- correct the upstream mobile vertical rhythm so the service heading starts at the PSD position;
- restore product titles and `Includes` to the PSD card-heading size;
- restore ribbons to their separate PSD size;
- after typography changes, re-check that the free-call ribbon, `Flagship`, `4 SESSIONS`, `Special Offer`, prices and buttons remain aligned and stay inside the card.

The later `In real life` title is already only about `5px` from the PSD, so the correction must preserve downstream section boundaries rather than adding a permanent negative offset to the whole remainder of the page.

### P1 — Neurocoaching mobile: remove cumulative drift after the first pricing card

The first card starts almost exactly at the PSD coordinate, but the wrong typography and internal rhythm accumulate through the second card and later sections.

| Element | PSD Y | Production Y | Delta |
|---|---:|---:|---:|
| `Services | Neurointegration` | 2837 | 2836 | -1 |
| `Individual NeuroSprint Coaching` | 2969 | 2970 | +1 |
| First `Includes` | 3302 | 3303 | +1 |
| `Integrated Transformation` | 4134 | 4151 | +17 |
| `Flagship` | 4349 | 4358 | +9 |
| Second `Includes` | 4702 | 4719 | +17 |
| `Special Offer` | 5318 | 5339 | +21 |
| `In real life` | 8909 | 8962 | +53 |
| CTA title | 9337 | 9378 | +41 |
| `FAQs` | 9645 | 9689 | +44 |

Required result: preserve the already-correct start of the services section, restore the PSD typography hierarchy, then tune card/reviews heights so the later shared blocks return to their source coordinates.

### P1 — Neurocoaching desktop: undo two non-PSD height overrides

The desktop layout has two confirmed structural deviations:

1. The hero is `960px` high on production instead of the PSD `909px`. A later `min-width:1024px` CSS override also raises the hero paragraph from its original PSD-oriented treatment to `18px`. This pushes Education and most following sections down by about `51px`.
2. Reviews is about `817px` high instead of the PSD `741px`, adding another approximately `76px` before `In real life`.

Key boundaries:

| Boundary | PSD | Production | Delta |
|---|---:|---:|---:|
| Education start | 909 | 960 | +51 |
| Credentials start | 1383 | 1434 | +51 |
| Difference start | 1885 | 1936 | +51 |
| Services start | 2682 | 2741 | +59 |
| Story start | 4653 | 4704 | +51 |
| Method start | 5719 | 5770 | +51 |
| Suitable start | 6447 | 6498 | +51 |
| Reviews start | 7195 | 7248 | +53 |
| `In real life` start | 7932 | 8063 | +131 |
| CTA start | 9035 | 9166 | +131 |
| FAQ start | 9431 | 9562 | +131 |

Required result: restore the `909px` hero and PSD paragraph wrapping, return Reviews to the source height, then verify the downstream shared boundaries. The customer-approved deletion of `NEUROINTEGRATION COACHING` and replacement of the Russian-profile link text must remain unchanged.

## Verified items — do not reopen unless a new regression appears

- Production responds normally; the public-theme performance release removed historical Elementor/Pro Elements/ElementsKit/Google Fonts bundles from public pages.
- Mobile Slow 4G check after that release: about 33 requests, FCP/LCP about `2.01s`, CLS `0`, no external hosts, no console errors.
- No horizontal overflow at `320px` or `390px` on About, Career Services, or Neurocoaching.
- Mobile menu background uses the approved dark purple.
- Former fixed-width mobile overflow in Neurocoaching content/cards is resolved.
- About text columns now fit the mobile viewport.
- About mobile FAQ photo uses the supplied jumping image and the crop remains readable.
- Neurocoaching FAQ uses the supplied higher-resolution mountain photo on mobile and desktop.
- The Neurocoaching purple kicker was removed; the Russian-profile link text was replaced as requested.
- Certificate lightbox shows the certificate itself without the tall opaque rectangle; mixed certificate aspect ratios are handled on a transparent overlay.
- Shared mobile gallery images use the widened layout. Current measured image width is `294px` at a `320px` viewport and `364px` at a `390px` viewport.
- Shared gallery spacing is `10px` from image to dots and `62px` from dots to the following dark section.
- Gallery images load successfully; blank lazy images in an instant full-page capture are a capture-timing artefact, not a live broken-image defect.
- About and Career desktop section boundaries are within low single-digit pixel tolerances of the retained source audit; no material desktop rebuild is currently required there.

## Intentional PSD exceptions

- Later customer-supplied copy and photographs override the older PSD layers.
- Gallery pagination represents the real current number of slides rather than the decorative number of circles in an old PSD.
- The Neurocoaching price remains consistent across desktop and mobile; the older source conflict (`350 €` desktop versus `150 €` mobile) is not reproduced on production.

## Recommended correction order

1. Remove the global `18/22px` mobile service-heading override and restore per-role PSD typography.
2. Fix Career mobile upstream/service vertical rhythm.
3. Fix Neurocoaching mobile cumulative card/reviews drift.
4. Restore Neurocoaching desktop hero and Reviews heights.
5. Run one final live acceptance pass at `320`, `390`, and source desktop widths, checking only the affected sections plus shared-component regressions.
