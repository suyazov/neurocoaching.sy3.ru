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
 return {url:location.href,width:innerWidth,errors,brokenImages,gaps,cards,headings};
}
