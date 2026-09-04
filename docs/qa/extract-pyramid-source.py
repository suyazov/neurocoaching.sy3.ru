"""Export cached transformed pyramid pixels from the latest mobile PSD.

The embedded original uses different proportions. The PSD layer's own raster
channels preserve the designer's transform and label sizes. No AI redraw.
"""
import sys
from psd_tools import PSDImage

psd = PSDImage.open(sys.argv[1])
root = next(layer for layer in psd if layer.name == 'Tablet 320 px')
layer = next(layer for layer in root.descendants() if layer.kind == 'smartobject' and layer.name == 'neuro_pyramid_web_transparent copy')
layer.topil().save(sys.argv[2])
print(layer.smart_object.filename, layer.bbox)
