"""Rebuild the OFL web subset without changing glyph outlines or metrics.

Run with fonttools[woff] installed. The original font and OFL-Lato.txt stay
bundled; the derivative's internal family is renamed to respect the RFN.
"""
from pathlib import Path
from fontTools import subset
from fontTools.ttLib import TTFont
from fontTools.pens.recordingPen import DecomposingRecordingPen

fonts = Path(__file__).resolve().parents[2] / "wordpress/wp-content/themes/neurocoaching/assets/fonts"
source = TTFont(fonts / "lato-heavy-800.woff2")
font = TTFont(fonts / "lato-heavy-800.woff2")
options = subset.Options()
options.layout_features = ["*"]
options.name_IDs = ["*"]
options.name_legacy = True
options.name_languages = ["*"]
options.glyph_names = True
subsetter = subset.Subsetter(options=options)
unicodes = subset.parse_unicodes(
    "0000-00FF,0131,0152-0153,02BB-02BC,02C6,02DA,02DC,0304,0308,0329,"
    "2000-206F,2074,20AC,2122,2191,2193,2212,2215,FEFF,FFFD"
)
subsetter.populate(unicodes=unicodes)
subsetter.subset(font)
names = {
    1: "Belka Heavy Latin", 2: "Regular", 3: "BelkaHeavyLatin-800-20260904",
    4: "Belka Heavy Latin", 6: "BelkaHeavyLatin-800", 16: "Belka Heavy Latin",
    17: "Regular", 18: "Belka Heavy Latin", 21: "Belka Heavy Latin", 22: "Regular",
}
for record in font["name"].names:
    if record.nameID in names:
        record.string = names[record.nameID].encode(record.getEncoding())
font.flavor = "woff2"
target = fonts / "belka-heavy-800-latin.woff2"
font.save(target)

# Verify the actual serialized file, not only the in-memory subset.
result = TTFont(target)
assert source["head"].unitsPerEm == result["head"].unitsPerEm
for table, keys in {
    "hhea": ["ascent", "descent", "lineGap"],
    "OS/2": ["sTypoAscender", "sTypoDescender", "sTypoLineGap", "usWinAscent", "usWinDescent"],
}.items():
    for key in keys:
        assert getattr(source[table], key) == getattr(result[table], key), key
original_glyphs, subset_glyphs = source.getGlyphSet(), result.getGlyphSet()
original_map = source.getBestCmap()
for char, glyph in result.getBestCmap().items():
    original = original_map[char]
    assert source["hmtx"][original] == result["hmtx"][glyph], hex(char)
    before = DecomposingRecordingPen(original_glyphs)
    after = DecomposingRecordingPen(subset_glyphs)
    original_glyphs[original].draw(before)
    subset_glyphs[glyph].draw(after)
    assert before.value == after.value, hex(char)
print(f"Verified {len(result.getBestCmap())} characters: identical metrics/outlines; {target.stat().st_size} bytes")
