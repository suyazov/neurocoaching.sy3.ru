# Interaction parity audit

Task: `CODEX-TASK-TASK-ISSUE-SUYAZOV_NEUROCOACHING.SY3.RU-818-G1`

Sources inspected: the five verified PSD files in `original-client-psd.zip`, covering the six About, Career Services, and Neurocoaching desktop/mobile layouts, plus the existing About layer manifest and current theme assets. PSD structure was inspected without full-document compositing.

## Source limitation

Each route's `In real life` group contains exactly one usable source photograph:

- About: `about-life-source.webp` (PSD smart-object source photo by the sea).
- Career Services: `career-life.webp` (PSD smart-object `IMG_2842`).
- Neurocoaching: `neuro-life.webp` (the single source gathering photo).

No additional legitimate hidden or alternate gallery photographs were found in those PSD groups. The implementation therefore starts with one slide per route, disables unavailable previous/next actions, and does not manufacture duplicate slides. Owners can add Media Library image URLs, one per line, in Customizer → Neurocoaching content. The component then provides wraparound previous/next, active pagination, Left/Right/Home/End keyboard commands, and touch swipe.

## Interaction inventory and result

| Element represented in PSD | Routes | Intended/current result |
|---|---|---|
| Logo and primary navigation | All | Real links; current route is announced; FAQ jumps to the route's FAQ section. |
| Mobile burger/open-menu state | All mobile | Real button with `aria-expanded`, accessible changing label, link-close and Escape-close behavior. |
| LinkedIn, email, Telegram, Instagram | About/header and gallery sections | Separate semantic links and separate WordPress URL settings; Instagram no longer points at the LinkedIn setting and email no longer points at the booking setting. |
| Booking, consultation, package and CTA controls | All | Real anchors using the WordPress booking URL; visible labels remain DOM text. |
| `View more` + arrow | All | Real same-page links to the full credentials section; not a decorative raster. |
| Reviews | Career Services, Neurocoaching | Real blockquotes and profile links. Horizontally overflowing PSD tracks are focusable scroll regions with Left/Right keyboard browsing and touch/native scrolling; no controls absent from the PSD were invented. |
| `In real life` arrows and dots | All | Replaced fake/static controls with the shared accessible carousel described above. Pagination state is generated from the real slide collection. |
| FAQ rows and plus/minus affordance | All | Native keyboard-operable `details`/`summary` accordions with DOM answers. |
| External science link | Neurocoaching | Preserved as a real destination link. |

Broken references to nonexistent certificate and FAQ image variants on Career Services and Neurocoaching were also corrected to the extracted source assets already present in the theme.
