// Make equal-scale reference / browser section pairs. No baseline is overwritten.
const fs = require('node:fs');
const {execFileSync} = require('node:child_process');
const [,,root,phase='before'] = process.argv;
const ranges = {
  about:[[0,1391],[1391,1780],[1780,2360],[2360,3200],[3200,3634],[3634,3884],[3884,5753]],
  career:[[0,1525],[1525,1914],[1914,2493],[2493,3343],[3343,5224],[5224,6238],[6238,6764],[6764,7198],[7198,7448],[7448,9307]],
  neuro:[[0,1026],[1026,1417],[1417,2000],[2000,2784],[2784,5498],[5498,6722],[6722,7738],[7738,8416],[8416,8862],[8862,9301],[9301,9588],[9588,11553]]
};
for(const [page,sections] of Object.entries(ranges)) {
  const metrics = JSON.parse(fs.readFileSync(`/tmp/belka-audit-${page}-${phase}-320.json`));
  sections.forEach(([top,bottom],i)=>{
    const section=metrics.sections[i]; if(!section) return;
    const source=`${root}/${page}-${i}-source.png`, live=`${root}/${page}-${i}-${phase}.png`;
    execFileSync('convert',[`${root}/${page}-source.png`,'-crop',`320x${bottom-top}+0+${top}`,'+repage',source]);
    execFileSync('convert',[`/tmp/belka-audit-${page}-${phase}-320.png`,'-crop',`320x${Math.ceil(section.h)}+0+${Math.round(section.y)}`,'+repage',live]);
    execFileSync('convert',[source,live,'-background','#dddddd','-gravity','North','+append',`${root}/${page}-${i}-pair-${phase}.png`]);
  });
}
