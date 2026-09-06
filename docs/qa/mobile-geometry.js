async () => {
 await document.fonts.ready;
 const rect=e=>{const r=e.getBoundingClientRect();return {x:r.x,y:r.y+scrollY,w:r.width,h:r.height,right:r.right,bottom:r.bottom+scrollY}};
 const errors=[], cards=[...document.querySelectorAll('.site-service-card')].map(card=>{
 const c=rect(card), nodes=[...card.querySelectorAll(':scope>h3,:scope>h4,:scope>p,:scope>ul,:scope>a.site-button,.nc-about__service-summary,.nc-about__programmes')].filter(e=>e.offsetHeight).map(e=>({name:e.className||e.tagName, text:e.textContent.slice(0,50),...rect(e)}));
 for(const n of nodes)if(n.x<c.x-3||n.right>c.right+3||n.y<c.y-3||n.bottom>c.bottom+3) errors.push({kind:'card containment',card:card.querySelector('h3')?.textContent,node:n});
 for(let i=0;i<nodes.length;i++)for(let j=i+1;j<nodes.length;j++){const a=nodes[i],b=nodes[j];if(Math.min(a.right,b.right)-Math.max(a.x,b.x)>4&&Math.min(a.bottom,b.bottom)-Math.max(a.y,b.y)>4)errors.push({kind:'card overlap',card:card.querySelector('h3')?.textContent,nodes:[a.name,b.name],texts:[a.text,b.text]});}
 return {title:card.querySelector('h3')?.textContent,rect:c,nodes};
 });
 const gallery=document.querySelector('.site-life'),photo=gallery?.querySelector('.nc-gallery__viewport'),dots=gallery?.querySelector('.nc-gallery__pagination');
 const gaps=gallery&&photo&&dots?{imageToDots:rect(dots).y-rect(photo).bottom,dotsToNext:rect(gallery.nextElementSibling).y-rect(dots).bottom,photo:rect(photo),count:dots.children.length}:null;
 const headings=[...document.querySelectorAll('.site-page h1,.site-page h2,.site-page h3,.site-page h4')].map(e=>({text:e.textContent.trim().slice(0,80),font:getComputedStyle(e).font,rect:rect(e)}));
 const brokenImages=[...document.images].filter(i=>i.offsetWidth&&(!i.complete||!i.naturalWidth)).map(i=>i.currentSrc||i.src);
 const title=document.querySelector('.neuro-story h2'),copy=document.querySelector('.neuro-story__copy');
 if(copy){const last=copy.lastElementChild;if(rect(last).bottom>rect(copy).bottom+12)errors.push({kind:'story copy exceeds panel',by:rect(last).bottom-rect(copy).bottom});}
 const overflow=document.documentElement.scrollWidth>innerWidth;
 if(overflow)errors.push({kind:'page overflow'});
 const heroCopy=document.querySelector('.neuro-hero__copy');
 let heroGaps=null;
 if(heroCopy&&innerWidth<=850){
  const profile=heroCopy.querySelector('.neuro-profile-link'),h=heroCopy.querySelector('h1'),p=heroCopy.querySelector('h1+p'),lead=heroCopy.querySelector('.neuro-lead'),button=heroCopy.querySelector('.neuro-button');
  heroGaps={profileToTitle:rect(h).y-rect(profile).bottom,titleToBody:rect(p).y-rect(h).bottom,bodyToLead:rect(lead).y-rect(p).bottom,leadToButton:rect(button).y-rect(lead).bottom,buttonToNext:rect(heroCopy.closest('.neuro-hero').nextElementSibling).y-rect(button).bottom};
  // The client's latest annotated example explicitly makes all five gaps equal.
  for(const [gap,actual] of Object.entries(heroGaps))if(Math.abs(actual-32)>1)errors.push({kind:'neuro hero spacing',gap,expected:32,actual});
 }
 let positioningGaps=null;
 const statement=document.querySelector('.career-positioning__statement');
 if(statement&&innerWidth<=850){
  const first=statement.querySelector('p'),zig=statement.querySelector('.career-positioning__zigzag'),last=statement.querySelector('p:last-child'),dividerHeight=parseFloat(getComputedStyle(statement,'::after').height);
  positioningGaps={beforeZig:rect(zig).y-rect(first).bottom,afterZig:rect(last).y-rect(zig).bottom,beforeLine:rect(statement).bottom-dividerHeight-rect(last).bottom};
  for(const [gap,actual] of Object.entries(positioningGaps))if(Math.abs(actual-32)>1)errors.push({kind:'career statement spacing',gap,expected:32,actual});
 }
 let differenceGaps=null,differenceMotif=null;
 const difference=document.querySelector('.neuro-difference');
 if(difference&&innerWidth<=850){
  const intro=difference.querySelector('.neuro-difference__intro'),process=difference.querySelector('.neuro-difference__process'),h=intro.querySelector('h2'),[p,q]=intro.querySelectorAll('p'),zig=intro.querySelector('.neuro-waves'),strong=intro.querySelector('strong'),h2=process.querySelector('h2'),dl=process.querySelector('dl'),steps=[...dl.children],gap=(a,b)=>rect(b).y-rect(a).bottom,dividerHeight=parseFloat(getComputedStyle(intro,'::after').height)||parseFloat(getComputedStyle(intro).borderBottomWidth)||0;
  differenceGaps={titleToBody:gap(h,p),betweenParagraphs:gap(p,q),beforeZig:gap(q,zig),afterZig:gap(zig,strong),beforeLine:rect(intro).bottom-dividerHeight-rect(strong).bottom,afterLine:rect(h2).y-rect(intro).bottom,titleToSteps:gap(h2,dl),betweenStep1And2:gap(steps[0],steps[1]),betweenStep2And3:gap(steps[1],steps[2])};
  for(const [gap,actual] of Object.entries(differenceGaps))if(Math.abs(actual-24)>1)errors.push({kind:'neuro difference spacing',gap,expected:24,actual});
  const motifStyle=getComputedStyle(zig,'::before');
  differenceMotif={fill:motifStyle.backgroundColor,mask:motifStyle.maskImage,display:getComputedStyle(zig).display,width:rect(zig).w,height:rect(zig).h};
  if(differenceMotif.fill!=='rgb(248, 241, 238)'||differenceMotif.mask==='none'||differenceMotif.display==='none'||differenceMotif.width<1||differenceMotif.height<1)errors.push({kind:'neuro difference motif invisible',actual:differenceMotif});
 }
 return {url:location.href,width:innerWidth,errors,brokenImages,gaps,cards,headings,heroGaps,positioningGaps,differenceGaps,differenceMotif};
}
