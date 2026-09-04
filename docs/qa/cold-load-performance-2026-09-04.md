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
Production delivery and post-deploy measurements pending at this commit.

No caching plugin is installed. Responses are served by LiteSpeed, but no page-cache
header was observed. Cache configuration needs a separate scoped owner approval;
no plugin/settings changes were made in this task.
