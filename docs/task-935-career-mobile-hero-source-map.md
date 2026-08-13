# TASK-935 Career mobile hero source map

Sole design source: `2_Career_320.psd`, SHA-256 `df5e94607b68bbb94c11edbde761c6213b1e69b6e1c5463fe23c9fb7160eb2db`.

The `Tablet 320 px` artboard is 320 px wide at document origin `(10143, 0)`. In `Block 1 > Image`, the `Place Your Image Here` shape (layer 9550) is the clipping mask at artboard-relative `x=-3..322, y=51..455` (325×404). Above it, `Фото Карьера` (smart object layer 11371, z-order 1, clipping enabled) has transform box `x=-2..301, y=36..491` (303×455). Its visible alpha bounds are `x=37..291, y=58..491`. The next copy group begins with the title at `x=13..289, y=504..578`, so the photo mask ends at y=455 and the title starts at y=504.

Layer 11371 embeds `Фото Карьера.png`, a 600×900 RGBA PNG (300 ppi, 706,909 bytes). The theme serves that embedded source as `assets/images/career-source/mobile-11371-career-photo.png`. At 320 CSS px it is placed at `x=-2, y=36` with rendered dimensions `303×454.5`; the containing mask begins at `x=-3, y=51`, is `325×404`, and ends at `y=455`. Width and height use the same scale factor (`303/600 = 454.5/900 = 0.505`), with the half-pixel browser height coming from the source's exact 2:3 ratio. The copy container retains its existing 44 px top padding, placing the title line box at y=499; the source layer's glyph bounds begin at y=504.

For 390 and 510 CSS px, the placed image and mask scale proportionally from the 320 composition while retaining the source's 2:3 ratio. At 768 CSS px the desktop `<img>` remains selected and keeps its existing source-faithful desktop composition. No page raster replaces the semantic `<picture>/<img>`, and hero text remains live DOM text.
