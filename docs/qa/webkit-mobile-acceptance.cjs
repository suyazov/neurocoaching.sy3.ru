// Second-engine smoke, not a claim of physical iPhone/Safari validation.
// Args: absolute Playwright package path, output directory.
const fs = require('node:fs');
const path = require('node:path');
const {webkit} = require(process.argv[2]);
const output = process.argv[3];
const geometry = fs.readFileSync(path.join(__dirname,'mobile-geometry.js'),'utf8');
const interactions = fs.readFileSync(path.join(__dirname,'mobile-interactions.js'),'utf8');
(async()=>{
  fs.mkdirSync(output,{recursive:true});
  const browser = await webkit.launch();
  try {
    const context = await browser.newContext({viewport:{width:320,height:844},deviceScaleFactor:1,isMobile:true,hasTouch:true});
    const page = await context.newPage();
    const errors = [], matrix = [];
    page.on('pageerror',e=>errors.push(e.message));
    for(const [name,route] of [['about','/'],['career','/career-services/'],['neuro','/neurocoaching/']]) {
      const response = await page.goto('https://digitalbelka.com'+route,{waitUntil:'load',timeout:30000});
      await page.evaluate(async()=>{
        await document.fonts.ready;
        document.querySelector('.cky-btn-reject')?.click();
        const images=[...document.images].filter(i=>i.getAttribute('src'));
        images.forEach(i=>i.loading='eager');
        await Promise.race([Promise.all(images.map(i=>i.decode().catch(()=>{}))),new Promise(r=>setTimeout(r,8000))]);
      });
      for(const width of [320,375,390,430]) {
        await page.setViewportSize({width,height:844});
        const g = await page.evaluate('('+geometry+')()');
        const specific = await page.evaluate(()=>({
          suitableHeight:document.querySelector('.career-suitable h2')?.clientHeight,
          pricingFonts:[...new Set([...document.querySelectorAll('.site-service-card h3,.site-service-card h4')].map(e=>getComputedStyle(e).font))],
          profileHeights:[...document.querySelectorAll('.neuro-review-track header a')].map(e=>e.clientHeight),
          premiumColor:document.querySelector('.career-card--featured .career-button')?getComputedStyle(document.querySelector('.career-card--featured .career-button')).backgroundColor:null
        }));
        const interactive=name==='career'?await page.evaluate('('+interactions+')()'):null;
        const row={name,width,status:response.status(),errors:[...g.errors,...(interactive?.errors||[])],brokenImages:g.brokenImages,gaps:g.gaps,specific,reviews:interactive?.reviews};
        matrix.push(row);console.log(JSON.stringify(row));
      }
    }
    fs.writeFileSync(path.join(output,'matrix.json'),JSON.stringify({engine:browser.version(),errors,matrix},null,2)+'\n');
    if(errors.length||matrix.some(r=>r.status!==200||r.errors.length||r.brokenImages.length))process.exitCode=1;
  } finally {await browser.close();}
})().catch(e=>{console.error(e);process.exitCode=1;});
