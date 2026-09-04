// Assemble retained native-scale evidence. No screenshot/image rescaling.
const fs = require('node:fs');
const path = require('node:path');
const {execFileSync} = require('node:child_process');
const out=__dirname, temp=process.argv[2];
if(!temp) throw new Error('Pass the PSD extraction directory');
const rows=require('./findings.json'), widths=[320,375,390,430];
const names={about:'About',career:'Career services',neuro:'Neurocoaching'};
const esc=s=>String(s).replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;');
for(const d of ['evidence','metrics','sources'])fs.mkdirSync(path.join(out,d),{recursive:true});
const copy=(from,to)=>fs.copyFileSync(from,path.join(out,to));
const read=f=>JSON.parse(fs.readFileSync(f));
const matrix=[];
for(const p of Object.keys(names)){
  copy(`${temp}/${p}-source.json`,`sources/${p}-source.json`);
  copy(`${temp}/${p}-source.png`,`sources/${p}-source.png`);
  for(const w of widths){
    const prefix=`/tmp/belka-audit-${p}`;
    const baseline=read(`${prefix}-before-${w}.json`), candidate=read(`${prefix}-candidate-${w}.json`), published=read(`${prefix}-published-${w}.json`), geometry=read(`${prefix}-published-geometry-${w}.json`);
    const differences=candidate.elements.flatMap((e,i)=>['x','y','w','h','font'].filter(k=>e[k]!==published.elements[i]?.[k]).map(k=>`${i}:${k}`));
    if(differences.length||geometry.errors.length||geometry.brokenImages.length)throw new Error(`${p}/${w}: failed proof`);
    matrix.push({page:p,width:w,stageProductionDifferences:differences,errors:geometry.errors,brokenImages:geometry.brokenImages,gaps:geometry.gaps,sectionHeightsBefore:baseline.sections.map(s=>s.h),sectionHeightsPublished:published.sections.map(s=>s.h)});
    for(const phase of ['before','candidate','published'])copy(`${prefix}-${phase}-${w}.json`,`metrics/${p}-${phase}-${w}.json`);
    copy(`${prefix}-published-geometry-${w}.json`,`metrics/${p}-geometry-${w}.json`);
    // Lossless conversion keeps every pixel and exact dimensions, but reduces repo size.
    execFileSync('convert',[`${prefix}-published-${w}.png`,'-define','webp:lossless=true',`${out}/evidence/${p}-published-${w}.webp`]);
    if([320,430].includes(w)){
      const interactions=read(`${prefix}-interactions-published-${w}.json`);
      if(interactions.errors.length)throw new Error(`${p}/${w}: interactive failure`);
      copy(`${prefix}-interactions-published-${w}.json`,`metrics/${p}-interactions-${w}.json`);
    }
  }
  const network=read(`/tmp/belka-audit-${p}-published-network.json`);
  if(network.errors.length||network.failedResources.length)throw new Error(`${p}: runtime/network failure`);
  copy(`/tmp/belka-audit-${p}-published-network.json`,`metrics/${p}-network.json`);
  copy(`/tmp/belka-audit-${p}-desktop-before.json`,`metrics/${p}-desktop-before.json`);
  copy(`/tmp/belka-audit-${p}-desktop-candidate.json`,`metrics/${p}-desktop-candidate.json`);
  copy(`/tmp/belka-audit-${p}-desktop-published.json`,`metrics/${p}-desktop-published.json`);
}
for(const [p,i] of rows){
  for(const phase of ['before','published'])copy(`${temp}/${p}-${i}-pair-${phase}.png`,`evidence/${p}-${i}-${phase}.png`);
}
for(const p of ['privacy','contact'])for(const w of widths)copy(`/tmp/belka-${p}-published-${w}.json`,`metrics/${p}-${w}.json`);
for(const p of ['privacy','contact'])copy(`/tmp/belka-${p}-published-430.png`,`evidence/${p}-430.png`);
for(const p of ['certificate-320','menu-430'])copy(`/tmp/belka-audit-${p}.png`,`evidence/${p}.png`);
for(const p of ['integrity','themes'])copy(`/tmp/belka-final-${p}.json`,`metrics/final-${p}.json`);
fs.writeFileSync(path.join(out,'metrics','matrix.json'),JSON.stringify(matrix,null,2)+'\n');
const table=rows.map(([p,i,block,psd,before,fix])=>`<tr><td><a href="#${p}-${i}">${names[p]} → ${esc(block)}</a></td><td>${esc(psd)}</td><td>${esc(before)}</td><td>${esc(fix)}</td></tr>`).join('');
const pairs=rows.map(([p,i,block,,,fix])=>`<section id="${p}-${i}"><h2>${names[p]} — ${esc(block)}</h2><p>${esc(fix)}</p><p>Слева PSD, справа опубликованный сайт. Оба фрагмента: 320 px, масштаб 1:1. Верх блока выровнен, серое — вне высоты более короткого фрагмента.</p><p><a href="evidence/${p}-${i}-before.png">PSD / сайт до исправления</a> · <a href="evidence/${p}-${i}-published.png">Открыть финальную пару</a></p><div class="comparison"><img loading="lazy" src="evidence/${p}-${i}-published.png" width="640" alt="PSD / опубликованный сайт: ${esc(block)}"></div></section>`).join('');
fs.writeFileSync(path.join(out,'index.html'),`<!doctype html><html lang="ru"><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Digital Belka — мобильная сверка 04.09.2026</title><style>body{max-width:1200px;margin:24px auto;padding:0 20px;color:#292331;background:#faf8fc;font:16px/1.55 system-ui}h1,h2{line-height:1.2}a{color:#694194}table{border-collapse:collapse;min-width:1000px}td,th{padding:12px;border:1px solid #d8cce2;vertical-align:top}th{text-align:left;background:#eee5f5}section{margin:60px 0;padding-top:20px;border-top:2px solid #855cac}.comparison{overflow-x:auto}.comparison img{display:block;width:640px;max-width:none;height:auto}aside{border-left:4px solid #855cac;padding:12px 20px;background:#eee5f5}.scroll{overflow:auto}</style><h1>Digital Belka — визуальная сверка мобильных страниц</h1><p>4 сентября 2026 · опубликована тема 1.0.20 · выполнено напрямую, без Kimi/Bridge.</p><aside>Это отчёт об исправленных и проверенных расхождениях, не заявление о 100% попиксельном совпадении. Цена NeuroSprint, другой поздний референс первого фото About, изменённые тексты/отзывы и недоступные PSD служебных страниц перечислены в <a href="README.md">ограничениях и противоречиях</a>. Все 29 блоков сопоставлены при 320 px; 375/390/430 проверены как адаптация, а не масштабированная копия PSD.</aside><p><a href="metrics/matrix.json">Матрица 12 проверок</a> · <a href="README.md">Подробный отчёт и ограничения</a></p><h2>Опубликованные страницы целиком</h2>${Object.entries(names).map(([p,n])=>`<p>${n}: ${widths.map(w=>`<a href="evidence/${p}-published-${w}.webp">${w} px</a>`).join(' · ')}</p>`).join('')}<h2>Реестр расхождений</h2><div class="scroll"><table><thead><tr><th>Страница / блок</th><th>PSD + поздние указания</th><th>До исправлений</th><th>Исправление / результат</th></tr></thead><tbody>${table}</tbody></table></div>${pairs}<h2>Страницы без PSD</h2><p><a href="evidence/privacy-430.png">Privacy policy</a>: восстановлен неизменённый текст. <a href="evidence/contact-430.png">Contact</a>: проверена адаптация формы, без отправки сообщения.</p></html>`);
const md=['# Таблица расхождений','', 'Во всех парах слева PSD, справа сайт, каждый фрагмент шириной 320 px без масштабирования. Статусы относятся к указанным исправлениям; общие противоречия — в README.md.','', '| Страница / блок | Как в PSD / поздних правках | Как было на сайте | Исправление и опубликованный результат |','|---|---|---|---|'];
for(const [p,i,b,s,before,fix]of rows)md.push(`| ${names[p]} → ${b} | ${s.replaceAll('|','\\|')} | ${before} | ${fix} [PSD / сайт](evidence/${p}-${i}-published.png) · [до](evidence/${p}-${i}-before.png) |`);
fs.writeFileSync(path.join(out,'TABLE.md'),md.join('\n')+'\n');
console.log(JSON.stringify({rows:rows.length,viewports:matrix.length,output:out}));
