// Package a fresh, anonymous production capture without rescaling PSD or site.
// Usage: node docs/qa/package-mobile-acceptance.cjs <capture-dir> <output-dir>
const fs = require('node:fs');
const path = require('node:path');
const {execFileSync} = require('node:child_process');
const [,, capture, output] = process.argv;
if (!capture || !output) throw new Error('Capture and output directories required');
const references = path.join(__dirname, 'full-mobile-20260904/sources');
const ranges = {
  about:[[0,1391],[1391,1780],[1780,2360],[2360,3200],[3200,3634],[3634,3884],[3884,5753]],
  career:[[0,1525],[1525,1914],[1914,2493],[2493,3343],[3343,5224],[5224,6238],[6238,6764],[6764,7198],[7198,7448],[7448,9307]],
  neuro:[[0,1026],[1026,1417],[1417,2000],[2000,2784],[2784,5498],[5498,6722],[6722,7738],[7738,8416],[8416,8862],[8862,9301],[9301,9588],[9588,11553]]
};
fs.mkdirSync(path.join(output, 'evidence'), {recursive:true});
fs.mkdirSync(path.join(output, 'metrics'), {recursive:true});
const matrix = [];
for (const [page, sections] of Object.entries(ranges)) {
  for (const width of [320,375,390,430]) {
    for (const kind of ['', '-geometry']) {
      const file = `${page}${kind}-${width}.json`;
      fs.copyFileSync(path.join(capture,file), path.join(output,'metrics',file));
    }
    const geometry = JSON.parse(fs.readFileSync(path.join(capture,`${page}-geometry-${width}.json`)));
    matrix.push({page,width,errors:geometry.errors,brokenImages:geometry.brokenImages,gaps:geometry.gaps});
    execFileSync('convert', [path.join(capture,`${page}-${width}.png`),'-define','webp:lossless=true',path.join(output,'evidence',`${page}-${width}.webp`)]);
  }
  for (const width of [320,430]) {
    const file = `${page}-interactions-${width}.json`;
    fs.copyFileSync(path.join(capture,file),path.join(output,'metrics',file));
  }
  const metrics = JSON.parse(fs.readFileSync(path.join(capture,`${page}-320.json`)));
  if (metrics.sections.length !== sections.length || metrics.width !== 320 || metrics.admin) throw new Error(`Invalid capture: ${page}`);
  sections.forEach(([top,bottom],i) => {
    const s = metrics.sections[i];
    execFileSync('convert', [
      '(',path.join(references,`${page}-source.png`),'-crop',`320x${bottom-top}+0+${top}`,'+repage',')',
      '(',path.join(capture,`${page}-320.png`),'-crop',`320x${Math.ceil(s.h)}+0+${Math.round(s.y)}`,'+repage',')',
      '-background','#ddd','-gravity','North','+append','-define','webp:lossless=true',path.join(output,'evidence',`${page}-${i}-pair.webp`)
    ]);
  });
}
fs.writeFileSync(path.join(output,'metrics/matrix.json'),JSON.stringify(matrix,null,2)+'\n');
for(const file of fs.readdirSync(capture).filter(f=>/^(about|career|neuro|contact|privacy-policy)-.*\.json$/.test(f)||f==='integrity.json')) {
  fs.copyFileSync(path.join(capture,file),path.join(output,'metrics',file));
}
console.log(JSON.stringify({pages:3,blocks:29,viewports:12,geometryErrors:matrix.flatMap(x=>x.errors),imageErrors:matrix.flatMap(x=>x.brokenImages)}));
