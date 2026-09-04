# Cold-load follow-up — theme 1.0.19

Owner-authorized direct theme maintenance, without Kimi or Bridge.
Scope: reduce page-load work without changing the accepted design. No DNS,
hosting configuration, WordPress core/plugin updates, or consent-setting changes.

## Verified causes and changes

- The hidden legacy Elementor header/footer still rendered 21 KB of HTML and
  fetched a 131 KB PNG logo with `fetchpriority=high`. Register the theme's own
  header/footer locations so Elementor's unsupported-theme fallback does not
  replace the document shell. Legacy templates remain stored for OceanWP rollback;
  admin and Elementor preview are excluded. This also restores the actual theme
  `main#content` and skip link rather than discarding them.
- `show(0)` eagerly loaded the first two gallery images at page start, defeating
  the existing IntersectionObserver. Initial state already comes from PHP. Keep
  those requests lazy until near the gallery or user interaction.
- The original Heavy 800 font was 184,520 bytes. The Latin subset is 34,692 bytes
  (81.2% smaller). All 259 retained characters have identical outlines/advance
  widths and vertical metrics. Hinting and layout features retained. Original
  full font is the fallback for other characters; Cyrillic fallback verified in
  the browser. Derivative renamed internally per OFL reserved-name terms.
- About's mobile FAQ photo used the desktop 700x910 reserved ratio before loading
  its 1537x1346 source, then jumped by 151.9px at a 390px viewport. Supply the
  mobile source's real width/height. The fully loaded image/crop is unchanged.

Implementation references:
[Elementor location registration](https://developers.elementor.com/docs/themes/registering-locations),
[PRO Elements fallback source](https://github.com/proelements/proelements/blob/master/modules/theme-builder/classes/theme-support.php),
[FontTools subsetting](https://fonttools.readthedocs.io/en/latest/subset/index.html),
[OFL webfont naming](https://openfontlicense.org/webfonts-and-reserved-font-names/).

## Before and staging verification

Cold browser reload (`ignoreCache: true`), 390x844, Slow 4G, CPU 4x:

| Environment | TTFB | LCP | CLS |
|---|---:|---:|---:|
| Production 1.0.18, Sept 4 baseline | 933ms | 3036ms | 0 |
| Staging 1.0.19 | 202ms | 2111ms | 0 |

These environments differ; staging numbers are NOT a production speedup claim.
The baseline trace finished 38 requests, 773,976 encoded bytes including HTML.
Baseline curl: HTTP 200, DNS 275ms, TLS established at 494ms, TTFB 1975ms,
total 2143ms. DNS A resolves to 188.34.142.87; no AAAA returned.
The reported regional failure was not reproduced. Country/provider/error requested.

Verification:

- `php -l functions.php`, `node --check assets/js/navigation.js`, `git diff --check`.
- `node docs/qa/gallery-loading.test.cjs` covers lazy initialization, observer,
  navigation and browsers without IntersectionObserver.
- `docs/qa/subset-heavy-font.py` rebuilds/verifies the font with FontTools.
- WP CLI mock: header/footer registration works; Elementor preview remains excluded.
- Browser: no gallery requests before scrolling; requests start near gallery;
  selecting photo 3 succeeds; native first slide and active dot stay visible.
- Fully loaded About geometry matches prod at390; Career390, Neuro390/1440
  headings/paragraphs/gallery boxes and typography metrics match exactly.
- No horizontal overflow in those viewports. Staging a11y snapshot saved.

## Production delivery

Fresh full backup before replacement, verified in WP-admin Backups:
`digitalbelka.com-20260904-062230-asihfg.wpress`, 297.10 MB.
Theme1.0.19 delivered through WP-admin upload/replacement. Active theme remains
Neurocoaching; OceanWP remains installed. The updater displayed its generic
"plugin could not be reactivated" warning, but also confirmed theme update
success; active-theme and anonymous frontend read-back independently passed.
CSS SHA-256: `657a4f37b7a4c5f2b40eca476ad1a03859db6f1b181c2f7ac12f6e4dfbe0e010`.

Same-day production cold measurements (390x844, DPR1, Slow4G, CPU4x):

| Metric | Before1.0.18 | After1.0.19 |
|---|---:|---:|
| TTFB | 933ms | 954ms |
| First contentful paint | 2861ms | 2468ms |
| Largest contentful paint | 3036ms | 2501ms |
| Main frame load event | 6206ms | 3633ms |
| Finished network requests in trace | 38 | 24 |
| Encoded bytes including HTML | 773,976 | 251,331 |
| CLS | 0 | 0.017 |

The trace-driven changes reduced initial transfer by67.5%, with one measured
LCP improvement of535ms (17.6%). These are paired lab samples, not field-user
percentiles or a guarantee for every provider/device. Server latency did not
improve. The residual small CLS is associated with the normal Lato400 font swap;
do not report "zero CLS" for the final production trace.

Post-deploy checks:

- All three routes HTTP200; curl TTFB1.07–1.62s, total1.20–1.76s from this server.
- About390, Career390, Neuro390/1440: all measured loaded headings, paragraphs,
  hero/gallery bounds and type metrics exactly match the pre-change baseline.
- No horizontal overflow, failed resources, or console errors/warnings.
- No legacy Elementor header/footer DOM on any route; `main#content` restored.
- No gallery image requests before scrolling on any route. Gallery first image,
  selecting photo3, menu open/Escape-close, and certificate open/close pass.
- Certificate image background remains transparent. CookieYes Customise, closing
  preferences, Reject All, and reopening preferences work; consent stored only
  in the isolated test browser. Global consent settings/plugins not modified.
- FAQ mobile source reserves1537x1346 before load and retains the approved crop.
- Production mobile screenshot and a11y tree checked.

Evidence directory:
`/root/.codex/visualizations/2026/08/26/01a03e25-3797-7811-994c-ce007dd8534a/digitalbelka-1.0.19/`.
Runtime package: `/tmp/neurocoaching-1019.S5gryS/neurocoaching-1.0.19.zip`.
Review: https://github.com/suyazov/neurocoaching.sy3.ru/pull/184.

No caching plugin is installed. Responses are served by LiteSpeed, but no page-cache
header was observed. Cache configuration needs a separate scoped owner approval;
no plugin/settings changes were made in this task.

Remaining: the reported regional timeout still needs the client's country,
provider and exact browser error (requested during this task). Current checks
cannot prove or rule out routing/filtering/intermittent hosting failure there.
