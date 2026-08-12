# TASK-916 About source-to-code map

Sole design source: `1_About me_1320 и 320.psd`, SHA-256 `3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`. Bounds below are artboard-relative pixels read from the PSD layer tree; no staging layout was used as design truth.

## Mobile 320 artboard

| Visible source element | PSD bounds / style | Semantic source and CSS mapping |
|---|---|---|
| Header | `0,0,320×50`; logo `16,4,89×45`; socials x `145..235`; burger x `281` | `neurocoaching_header()`; fixed 320 px mobile header, independently positioned real links and button |
| Hero photo | mask `-4,50,326×405`; placed photo `-17,-5,356×530` | `.nc-about__hero-photo`; source asset remains an editable `<img>`, cropped at `320×405` with placed-image bounds `356×530`, `-17,-55` inside the mask |
| Hero text and CTA | eyebrow `15,489`; title `15,586,173×67`; lead `14,687`; copy `15,756,290×516`; button `15,1306,185×55` | `.nc-about__hero-copy`; dedicated mobile line breaks, type widths and button retained; hero ends at y `1391` |
| Education & Experience | band y `1391..1780`; title `15,1450`; cards `16,1567,213×153`, next x `251` | `.nc-about__education` and keyboard/touch certificate track; 389 px band with native horizontal browsing |
| Credentials | checks/text y `1831..2307`; single column x `16..302` | `#nc-about-credentials`; explicit 585 px mobile section, semantic list and source order |
| Services \| B2B format | heading `15,2365,190×68`; card field x `15..304`; Team Workshops `39,2499`; zigzag `39,2563`; ribbon `146,2563`; divider `37,2601,246×6`; copy x `39`; Programmes y `2838`; button `37,3120,163×53` | `.nc-about__services` / `.nc-about__service-card`; independent 320 composition with 290 px card, absolute source-aligned summary/programme groups and filled section button |
| In real life | heading `73,3243`; Instagram label/icon `68/231,3289`; photo `-1,3324,323×223`; PSD pagination y `3554` | `.nc-about__life` and `neurocoaching_gallery()`; centered section, clipped 323 px source crop, exactly three DOM dots; three real slides and keyboard/touch behavior retained |
| Main CTA | band `-1,3634,323×250`; heading `15,3671,233×74`; subtitle `16,3762`; button `15,3796,183×53` | `.nc-about__cta`; dedicated two-line heading width and source-filled light button |
| FAQ heading/questions | heading x `16`, y `3941`; questions x `14..306`, y `4028..5136`; 12 semantic rows | `.nc-about__faq`, `.nc-about__questions`, native `<details>/<summary>`; mobile row rhythm and plus/minus semantics retained |
| FAQ sidebar | image `16,5192,288×239`; separator `15,5446,290×6`; heading `16,5478,231×74`; copy `16,5578`; button `14,5642,186×53` | `.nc-about__faq aside`; independent image crop, separator and filled violet CTA instead of shared generic button styling |

At 321–850 CSS pixels the dedicated mobile structure remains in use. Only the header/photo field grows fluidly from its exact 320 bounds to the approved 390 first-viewport crop; content sections stay independently authored and the page width remains the viewport width.

## Desktop FAQ/sidebar

| Visible source element | PSD bounds | CSS mapping |
|---|---|---|
| FAQ group | `145,4256,983×1259` | `.nc-about__faq` centered at width 1030: 663 px question column + 26 px gutter + 290 px sidebar, with source header inset 52 px |
| Questions | `145,4359,663×1156`; text inset 50 px | `.nc-about__questions`; 81 px closed-row rhythm and source text inset |
| Sidebar image | visible mask `836,4361,290×375`; placed photo `808,4320,428×559` | semantic `<img>` cropped to `290×375` |
| Sidebar separator | `834,4760,294×6` | dedicated aside rule, not a shared component border |
| Sidebar copy | heading `836,4804,290×92`; paragraph `836,4931,275×36` | independent widths, 45/46 px heading and 18/20 px copy |
| Sidebar Book a call | `834,5040,293×63` | dedicated `293×63`, borderless `#855cac` fill with white text; generic `.nc-about__button` visual is overridden only in this sidebar |

All elements remain semantic DOM and WordPress-editable links/images. No page raster, canvas, giant SVG, hidden duplicate UI, WordPress data, uploads, core or plugins were introduced.
