(function () {
  const header = document.querySelector('[data-site-header]');
  const toggle = document.querySelector('[data-menu-toggle]');
  if (!header || !toggle) return;
  const toggleLabel = toggle.querySelector('.screen-reader-text');
  const setOpen = function (open) {
    header.classList.toggle('is-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    if (toggleLabel) toggleLabel.textContent = open ? 'Close menu' : 'Open menu';
  };
  toggle.addEventListener('click', function () {
    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });
  header.querySelectorAll('.nc-nav a').forEach(function (link) {
    link.addEventListener('click', function () {
      setOpen(false);
    });
  });
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      setOpen(false);
      toggle.focus();
    }
  });
}());

(function () {
  document.querySelectorAll('[data-carousel]').forEach(function (carousel) {
    const slides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
    const dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
    const previous = carousel.querySelector('[data-carousel-previous]');
    const next = carousel.querySelector('[data-carousel-next]');
    let active = 0;
    let touchStart = null;
    const show = function (index) {
      if (!slides.length) return;
      active = (index + slides.length) % slides.length;
      slides.forEach(function (slide, slideIndex) { slide.hidden = slideIndex !== active; });
      dots.forEach(function (dot, dotIndex) { dot.setAttribute('aria-current', String(dotIndex === active)); });
    };
    if (previous) previous.addEventListener('click', function () { show(active - 1); });
    if (next) next.addEventListener('click', function () { show(active + 1); });
    dots.forEach(function (dot, index) { dot.addEventListener('click', function () { show(index); }); });
    carousel.addEventListener('keydown', function (event) {
      if (event.key === 'ArrowLeft') { event.preventDefault(); show(active - 1); }
      if (event.key === 'ArrowRight') { event.preventDefault(); show(active + 1); }
      if (event.key === 'Home') { event.preventDefault(); show(0); }
      if (event.key === 'End') { event.preventDefault(); show(slides.length - 1); }
    });
    carousel.addEventListener('touchstart', function (event) { touchStart = event.changedTouches[0].clientX; }, { passive: true });
    carousel.addEventListener('touchend', function (event) {
      if (touchStart === null) return;
      const distance = event.changedTouches[0].clientX - touchStart;
      if (Math.abs(distance) >= 40) show(active + (distance < 0 ? 1 : -1));
      touchStart = null;
    }, { passive: true });
    show(0);
  });

  document.querySelectorAll('[data-horizontal-track]').forEach(function (track) {
    track.addEventListener('keydown', function (event) {
      if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
      event.preventDefault();
      track.scrollBy({ left: (event.key === 'ArrowRight' ? 1 : -1) * Math.max(260, track.clientWidth * 0.8), behavior: 'smooth' });
    });
  });
}());
