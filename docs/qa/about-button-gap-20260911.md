# About mobile CTA spacing — 2026-09-11

Owner reference: latest annotated About screenshot. Equalize the space after the intro CTA with the space before it.

Confirmed production baseline: paragraph-to-button 27px; button-to-purple-section 16px.
Change: mobile hero-copy bottom padding 24px → 35px, retaining the existing button positioning and upper gap. Theme 1.0.28. No desktop rule or other section changed.

Browser preview: 320/375/390/430px all 27px above and below.
Staging: 390px measured 27px above and below.
Production desktop baseline at 1440px: hero-copy padding 200px 0px 0px 52px, height 852px, relative button top 735px.

Published 1.0.28 through WordPress admin after completed full backup `digitalbelka.com-20260911-055852-3jm72y.wpress` (297 MB).
Production at 320/375/390/430px: above 27px / below 27px, no horizontal overflow, no injected preview styles. 430px screenshot visually inspected. Desktop 1440px unchanged against baseline.
Live CSS SHA-256 matches source: `ef3e54998627eb564e79959b56dd7a45c92e1086f31e3d06915d8fbc54a67023`.
Neurocoaching active; OceanWP retained. No content, plugin or core changes. This is a scoped CTA-gap check, not a renewed full PSD audit.
