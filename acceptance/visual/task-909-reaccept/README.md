# Emergency source reacceptance — #909

Task: `CODEX-TASK-EMERGENCY-NEUROCOACHING-REACCEPT-909`

Fresh no-cache Chromium acceptance was run on 2026-08-12 at 1440×900 and
390×844 for `/`, `/career-services/`, and `/neurocoaching/`. The six
`staging-*.png` files are the unchanged served staging DOM. They were reviewed
against the six immutable PSD-derived images in the parent directory, not
against a previous acceptance receipt.

## Owner-rejection finding and correction

Career and Neurocoaching omitted all three source social controls on desktop
and mobile. Their desktop navigation also remained in the header flex row,
which placed the FAQ item beneath the absolutely positioned CTA and visibly
clipped it. The shared header now renders the source LinkedIn, email, and
Telegram links on every route, and the two affected desktop navigation rows
use the source composition below the logo/social row. The four `candidate-*.png`
files are fresh captures of the staging DOM with exactly that PHP/CSS candidate
state applied non-persistently for visual review.

## Functional/browser evidence

`fresh-browser-audit.json` records the six candidate viewport runs:

- JavaScript/console/network errors: 0 on every route and viewport.
- Horizontal overflow: 0 on every route and viewport.
- Broken images: 0 on every route and viewport.
- Each route has one configured gallery slide; therefore no carousel arrows or
  pagination controls are rendered. No fake multi-page control is present.
- Each route exposes 12 native FAQ disclosures.
- Existing mobile menu, links, CTA anchors, View more anchors, review expansion,
  keyboard review-track browsing, and native FAQ controls remain semantic and
  executable.

Persistent staging delivery was not performed from this branch. After PR merge,
Bridge must deliver the exact merge and repeat the six no-cache live checks;
the candidate overlay is not a substitute for that mandatory post-merge gate.
