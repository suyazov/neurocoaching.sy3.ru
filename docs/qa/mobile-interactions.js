async()=>{
 const delay=ms=>new Promise(r=>setTimeout(r,ms)),frame=()=>new Promise(r=>requestAnimationFrame(()=>requestAnimationFrame(r)));
 const errors=[],result={url:location.href,width:innerWidth};
 const toggle=document.querySelector('[data-menu-toggle]');
 if(toggle.getAttribute('aria-expanded')==='true')toggle.click();
 toggle.click(); const header=document.querySelector('[data-site-header]'),nav=document.querySelector('#primary-navigation');
 result.menu={opens:toggle.getAttribute('aria-expanded')==='true',sameBackground:getComputedStyle(header).backgroundColor===getComputedStyle(nav).backgroundColor,background:getComputedStyle(nav).backgroundColor};
 document.dispatchEvent(new KeyboardEvent('keydown',{key:'Escape',bubbles:true})); result.menu.escapeCloses=toggle.getAttribute('aria-expanded')==='false';
 const viewer=document.querySelector('.certificate-lightbox'),vi=viewer.querySelector('img'),links=[...document.querySelectorAll('[data-certificate-lightbox]')];
 result.certificates=[];
 for(let i=0;i<links.length;i++){
 links[i].click();let decoded=await Promise.race([vi.decode().then(()=>true).catch(()=>false),delay(10000).then(()=>false)]);await frame();
 const r=vi.getBoundingClientRect(),ratio=vi.naturalWidth/vi.naturalHeight;
 result.certificates.push({index:i,loaded:decoded,transparent:getComputedStyle(vi).backgroundColor==='rgba(0, 0, 0, 0)',ratioError:Math.abs(r.width/r.height-ratio),fits:r.left>=0&&r.right<=innerWidth&&r.top>=0&&r.bottom<=innerHeight});
 viewer.querySelector('.certificate-lightbox__close').click();
 }
 links[0].click();viewer.querySelector('.certificate-lightbox__next').click();await vi.decode().catch(()=>{});result.certificateNext=vi.src===links[1%links.length].href;
 document.dispatchEvent(new KeyboardEvent('keydown',{key:'Escape',bubbles:true}));result.certificateEscape=viewer.hidden;
 const gallery=document.querySelector('[data-carousel]'),dots=[...gallery.querySelectorAll('[data-carousel-dot]')],slides=[...gallery.querySelectorAll('[data-carousel-slide]')];
 result.gallery=[];
 for(let index of [0,Math.floor(dots.length/2),dots.length-1]){dots[index].click();const im=slides[index].querySelector('img');await im.decode().catch(()=>{});await frame();result.gallery.push({index,active:!slides[index].hidden,loaded:!!im.naturalWidth&&im.complete,dot:dots[index].getAttribute('aria-current')==='true',ratioError:Math.abs(im.getBoundingClientRect().width/im.getBoundingClientRect().height-im.naturalWidth/im.naturalHeight)});}
 dots[0].click();await frame();
 result.faq=[];
 for(const detail of document.querySelectorAll('.site-faq details')){const was=detail.open;if(was)detail.querySelector('summary').click();detail.querySelector('summary').click();let p=detail.querySelector('p');result.faq.push({text:detail.querySelector('summary').innerText,opens:detail.open&&p.offsetHeight>0});detail.querySelector('summary').click();if(was)detail.querySelector('summary').click();}
 const button=document.querySelector('.career-review-more');
 if(button){const c=button.closest('blockquote'),h=c.offsetHeight;button.click();await frame();result.review={expands:button.getAttribute('aria-expanded')==='true',heightBefore:h,heightAfter:c.offsetHeight,allTextVisible:c.querySelector('p').scrollHeight<=c.querySelector('p').clientHeight+1};button.click();result.review.closes=button.getAttribute('aria-expanded')==='false';}
 if(Object.values(result.menu).some(v=>v===false))errors.push('menu');
 if(result.certificates.some(c=>!c.loaded||!c.transparent||!c.fits||c.ratioError>.015))errors.push('certificate');
 if(!result.certificateNext||!result.certificateEscape)errors.push('certificate controls');
 // A contain-fit image box intentionally differs from the intrinsic photo
 // ratio: the pixels retain their ratio and portrait photos have side space.
 if(result.gallery.some(g=>!g.active||!g.loaded||!g.dot)||(getComputedStyle(gallery.querySelector('img')).objectFit!=='contain'&&result.gallery.some(g=>g.ratioError>.015)))errors.push('gallery');
 if(result.faq.some(f=>!f.opens))errors.push('FAQ');
 if(result.review&&(!result.review.expands||!result.review.allTextVisible||!result.review.closes))errors.push('review expansion');
 result.errors=errors;scrollTo({top:0,behavior:'instant'});return result;
}
