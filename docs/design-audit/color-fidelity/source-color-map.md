# Source colour map — TASK-910

The five supplied PSD files were SHA-256 verified against the Bridge source-material manifest. Colours were read from text `StyleRun/FillColor`, solid-fill descriptors and existing layer manifests. The documents were not fully composited. Rounded descriptor channel values follow Photoshop's 8-bit display result (for example `245.996…` becomes `246`).

The audit proves that shared route tokens were invalid. About alone separates hero title `#3C2764`, general dark headings `#262626`, eyebrow/lead `#8D5EBC`, body copy `#5C5467`, strokes/FAQ accent `#855CAC`, paper `#F8F1EE`, and large dark sections `#3F2961`. Career and Neurocoaching also have dedicated desktop/mobile palettes: desktop semantic text is primarily `#2A2A2A/#5A5566/#7A5CA8`; mobile is `#3C2764/#262626/#5C5467/#8D5EBC`.

The complete distinct-colour inventory, source layer references, CSS selector/token mappings, computed RGB read-back, and screenshot pixel coordinates are in [source-color-map.json](source-color-map.json). Black, blue `#4012CB`, and some legacy footer/template colours remain inventoried because they occur in visible PSD layer metadata, but they are not reassigned to unrelated semantic elements in the implemented compositions.

Fresh no-cache staging captures:

- [About desktop](about-desktop-fresh.png) and [About mobile](about-mobile-fresh.png)
- [Career desktop](career-desktop-fresh.png) and [Career mobile](career-mobile-fresh.png)
- [Neurocoaching desktop](neurocoaching-desktop-fresh.png) and [Neurocoaching mobile](neurocoaching-mobile-fresh.png)

All six staging responses were HTTP 200. Computed styles exactly match the mapped source RGB values. Interior screenshot samples (not antialiased edges) exactly match the mapped paper, section, card and story surfaces. The required live strings remained present and `Internal Server Error` remained absent on every route.
