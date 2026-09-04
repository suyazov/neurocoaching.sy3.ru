"""Reproducible mobile Lato 2.015 subsets; desktop font files stay untouched.

Input: directory containing official Lato-{Light,Regular,Bold,Black,Italic}.ttf
from google/fonts commit 5d3b76120a319730fda218cc7410174a462b32cb/ofl/lato.
Dependencies: fonttools[woff]. Original OFL is bundled in the theme.
"""
import hashlib
import json
import sys
from pathlib import Path
from fontTools import subset
from fontTools.ttLib import TTFont
from fontTools.pens.recordingPen import DecomposingRecordingPen

source_dir = Path(sys.argv[1])
target_dir = Path(__file__).resolve().parents[2] / 'wordpress/wp-content/themes/neurocoaching/assets/fonts'
manifest = []
for style in ['Light', 'Regular', 'Bold', 'Black', 'Italic']:
    path = source_dir / f'Lato-{style}.ttf'
    original, font = TTFont(path), TTFont(path)
    assert abs(font['head'].fontRevision - 2.015) < .001
    options = subset.Options()
    options.layout_features = ['*']
    options.name_IDs = ['*']
    options.name_legacy = True
    options.name_languages = ['*']
    options.glyph_names = True
    subsetter = subset.Subsetter(options=options)
    subsetter.populate(unicodes=subset.parse_unicodes('0000-00FF,0131,0152-0153,02BB-02BC,02C6,02DA,02DC,0304,0308,0329,2000-206F,2074,20AC,2122,2191,2193,2212,2215,FEFF,FFFD'))
    subsetter.subset(font)
    family = f'Belka Mobile {style}'
    names = {1:family,2:'Regular',3:family.replace(' ','')+'-20260904',4:family,6:family.replace(' ',''),16:family,17:'Regular',18:family,21:family,22:'Regular'}
    for record in font['name'].names:
        if record.nameID in names:
            record.string = names[record.nameID].encode(record.getEncoding())
    font.flavor = 'woff2'
    target = target_dir / f'belka-mobile-{style.lower()}.woff2'
    font.save(target)
    result = TTFont(target)
    old_map = original.getBestCmap()
    old_glyphs, new_glyphs = original.getGlyphSet(), result.getGlyphSet()
    for char, glyph in result.getBestCmap().items():
        old = old_map[char]
        assert original['hmtx'][old] == result['hmtx'][glyph]
        before, after = DecomposingRecordingPen(old_glyphs), DecomposingRecordingPen(new_glyphs)
        old_glyphs[old].draw(before)
        new_glyphs[glyph].draw(after)
        assert before.value == after.value
    manifest.append({'source':path.name,'source_sha256':hashlib.sha256(path.read_bytes()).hexdigest(),'output':target.name,'bytes':target.stat().st_size,'verified':'identical retained outlines and advance widths'})
print(json.dumps(manifest, indent=2))
