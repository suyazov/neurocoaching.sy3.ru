# Mobile follow-up — themes 1.0.17 / 1.0.18

## Authority and source precedence

Owner requested direct work without Kimi/Bridge after the three-day production
audit, including the spoken corrections in `Правки 3 сентября _1.mov`.
The latest written request takes precedence over the older PSD where they
conflict: green-marked headings inside pricing cards must use the Corporate
ribbon's reference size. Therefore card titles, Includes/Programmes and ribbons
use IBM Plex Sans Bold 16/20px on mobile. Large Services section titles retain
their existing hierarchy. This is a client-requested amendment, not a claim
that the older PSD already had uniform typography.

## Corrections

1. Shared mobile service headings/ribbons are consistently 16/20px on all three
   routes. Purple card labels are also 16/20px, eliminating the Neurocoaching
   drop to 11px above the 360px breakpoint. Corporate uses the correct IBM font.
2. Neurocoaching featured title → label → zigzag now have real spacing: 16px
   and 12px above 360px. Price → Special Offer is 20px. Existing 320px spacing
   remains 25px / 26px / 13px respectively.
3. Career Flagship is visibly 37px high, not merely a 37px container whose SVG
   mask letterboxes the paint to about 17px. It is vertically centered on
   4 SESSIONS. The SVG mask is replaced with a CSS inward notch.
4. Free 30-min intro call starts at the paragraph's left edge and ends at the
   inner right border, including 320–360px. Height remains 32px.
5. Neurocoaching Flagship touches the inner right border and sits on the motif
   row instead of competing with the title.
6. Both Special Offer ribbons attach at the inner left border, preserve its
   purple outline, and end with an inward V notch rather than an arrow point.
7. Shared mobile gallery has 13px side margins throughout the mobile range,
   removing the 404px cap at 600/768px. Approved 10px image-to-pagination and
   62px pagination-to-next-section gaps are unchanged.
8. Two existing above-the-fold fonts are preloaded. The production cold trace
   identified a late Lato 900 swap moving the About copy. No plugins, DNS,
   hosting configuration, credentials or unrelated content were changed.
9. Final visual review caught the About divider crossing the top of On request
   (its old 134px offset put it 1px into the text box). Theme 1.0.18 moves only
   that mobile divider: 15px after the zigzag, 23px before the text. No section
   heights or subsequent content positions change. Staging verified at
   320/390/768px.

## Staging verification

- Browser checks: About, Career, Neurocoaching at 320, 360, 375, 390, 430, 600,
  768 CSS px. No horizontal overflow or service content outside card boundaries.
- Every affected heading computes to IBM Plex Sans Bold 16/20px. Card labels
  are 16/20px on both sides of the 360px breakpoint.
- Text-range intersection checks at 320px: no collisions in any pricing card.
- Gallery widths: 294, 334, 349, 364, 404, 574, 742px respectively; all retain
  10px / 62px vertical gaps.
- Visual checks of Neurocoaching at 390px and Career at 320px confirm actual
  ribbon paint, inward notches, text spacing and visible card outline.
- Desktop source widths remain unchanged: About 1320px hero 852px, services
  882px, life 944px; Career 1440px hero 1139px, services 1525px; Neurocoaching
  1440px hero 909px, Reviews 741px. No horizontal overflow.
- PHP lint and `git diff --check` pass.
- Staging cold Slow 4G / CPU 4x: LCP 2.158s, CLS 0, no console errors/warnings.
  This is not directly comparable to production because origin latency differs.

## Production baseline and remaining limitation

Before this release, production cold About at 390px / Slow 4G / CPU 4x:
TTFB 2.157s, FCP 3.956s, LCP 4.072s, load 6.943s, CLS 0.0657; 33 requests,
all same-origin, no failed resources or JavaScript errors. Hero download and
origin latency account for most of LCP. The client's complete regional outage
was not reproduced, so this release must not be described as a proven fix for
regional connectivity/hosting issues.

## Production delivery and read-back

- Theme 1.0.17 delivered through WP admin after fresh full backup
  `digitalbelka.com-20260903-202409-lomev3.wpress` (491.44 MB), verified in Backups.
- Active theme remains Neurocoaching; OceanWP rollback is installed. The generic
  plugin-reactivation warning on the theme updater did not deactivate the theme;
  verified both the Themes screen and anonymous frontend.
- Production stylesheet SHA-256 matches the release exactly:
  `14b0c81c5b364a4e6908325302503b694e5ebe41d28653ee6bb612f2d3b9ea04`.
- Anonymous checks on all three routes at 320/390/768px match staging. No card
  content outside bounds, no horizontal overflow, uniform 16/20px typography,
  approved gallery widths/spacing, correct attached and unclipped ribbons.
- Mobile menu opens/closes, header and dropdown both #855cac. First/middle/last
  gallery selections and wraparound work on all routes (61/21/15 slides).
- Certificate viewer works for landscape and portrait assets, transparent image
  background, no image border, correct aspect ratios and viewport containment.
- All three FAQ photos decode successfully. About mobile and Neurocoaching use
  the client replacements at 1537 × 1346; the Russian-profile label is correct.
- No browser warnings/errors on the three routes or the cold-load measurement.
- Production cold Slow 4G / CPU 4x after font preloads: TTFB 1.186s, FCP 4.480s,
  LCP 4.477s, load 6.999s, CLS 0. The layout shifts disappeared, but there is no
  demonstrated LCP improvement (baseline 4.072s). Do not present this as a speed
  fix or a fix for the client's regional outage. Document latency remains a
  measured limitation; infrastructure investigation is separate from this
  theme-only delivery.
- Evidence: local `digitalbelka-1.0.17/` folder contains viewport-checks.json,
  production screenshots and the cold performance trace.
- Theme 1.0.18 final divider correction is staging-verified; production pending
  another fresh full backup. All other runtime bytes are unchanged from 1.0.17.
