# About PSD measurement evidence

Source: `1_About me_1320 и 320.psd` (`sha256: 3a01b085418b0d919e84879adf19b585eb40568ad98c5cc92d748f770f1e334d`). Values are artboard-relative pixels; colours come from the PSD vector fill/stroke descriptors.

| Area | Measured PSD (1320 / 320) | Implemented CSS |
|---|---|---|
| Header + hero | photo 516×852 / 320×452; copy x=565 / x=15; hero 852 / 1391 | `516px 804px`, `height:852px`; mobile photo + header `452px`, hero `1391px`, copy `15px` |
| Education | band 1320×481 / 320×389; title x=195,y=99 / x=15,y=59; certificates 212×155, gap 27 / 213×156, gap 22 | band `481px` / `389px`; frame `930px`; certificates `212×155`, `27px` / `213×156`, `22px` |
| Credentials | x=196..1060, two columns; first rows y=1475,1574,1648,1722 / x=16, single column y=1831..2304 | two-column grid, `gap:33px 110px`, `padding:142px 0 139px`; mobile one column, `gap:26px`, `padding:54px 15px 58px` |
| Services / B2B | card x=146,y=2025, 1037×597, white fill, 3px `#855cac`; split x=676 (530 from outer left) / card x=12,y=2473, 295×727, white fill, 2px `#855cac` | outer `1037×597`; inner tracks `527px 504px` after 3px borders place split at x=530; mobile `295×727`, 2px border and independently positioned content |
| In real life | section y=2768, h=944, fill `#e9e1f3`; image 674×479; arrows 86×86 / mobile content y=3200..3634, image 323×223 | full-width `height:944px`, `#e9e1f3`, image/arrows exact; mobile `height:434px`, image `323×223`, mobile artboard background |
| CTA + FAQs | CTA y=3708,h=401; FAQ x=145, columns 663/428; right image 428×559 / CTA y=3634,h=250; FAQ x=16,width=292; right image crop 320×559 | CTA `401px` / `250px`; FAQ `1091px`, columns `663px 428px`; mobile margins `14px`, rows `64px`, image bleed to 320×559 |

Sampled palette: page `#f8f1ee`, CTA/education `#3f2961`, gallery `#e9e1f3`, accent/border `#855cac`, text `#252525`.
