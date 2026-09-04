"""Extract embedded PSD previews and text metrics for the mobile audit.

No recursive compositing and no generated design reference. Outputs are evidence,
not assets used by the site. Usage: python extract-mobile-psd.py PSD OUTPUT_PREFIX
"""
import hashlib
import json
import sys
from pathlib import Path
from psd_tools import PSDImage

source = Path(sys.argv[1])
prefix = Path(sys.argv[2])
psd = PSDImage.open(source)
roots = [layer for layer in psd if layer.is_group() and layer.name == 'Tablet 320 px']
if len(roots) != 1:
    raise ValueError([(layer.name, layer.bbox) for layer in psd])
root = roots[0]
origin_x, origin_y, right, bottom = root.bbox
merged = psd.topil()
merged.crop(root.bbox).save(str(prefix) + '.png')
rows = []
for layer in root.descendants():
    if not layer.is_visible():
        continue
    row = {'name': layer.name, 'kind': layer.kind,
           'bounds': [layer.left-origin_x, layer.top-origin_y, layer.width, layer.height]}
    if layer.kind == 'type':
        row['text'] = layer.text
        row['transform'] = list(layer.transform)
        fonts = layer.resource_dict.get('FontSet', [])
        row['runs'] = []
        for run in layer.engine_dict.get('StyleRun', {}).get('RunArray', []):
            style = run.get('StyleSheet', {}).get('StyleSheetData', {})
            font_id = int(style.get('Font', 0))
            font_name = str(fonts[font_id].get('Name', '')) if font_id < len(fonts) else ''
            size = float(style.get('FontSize', 0)) * abs(layer.transform[3])
            leading = float(style.get('Leading', 0)) * abs(layer.transform[3])
            row['runs'].append({'font':font_name, 'size':round(size,3), 'leading':round(leading,3),
                                'tracking':float(style.get('Tracking', 0))})
    rows.append(row)
data = {'source':str(source), 'sha256':hashlib.sha256(source.read_bytes()).hexdigest(),
        'root':root.name, 'bounds':root.bbox, 'size':[right-origin_x,bottom-origin_y], 'layers':rows}
Path(str(prefix)+'.json').write_text(json.dumps(data,ensure_ascii=False,indent=2))
print(json.dumps({k:v for k,v in data.items() if k != 'layers'},ensure_ascii=False))
