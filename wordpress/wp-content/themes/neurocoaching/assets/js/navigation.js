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
  const groups = Array.from(document.querySelectorAll('.nc-about__certificates,.career-certificates,.neuro-certificates'));
  if (!groups.length) return;

  const viewer = document.createElement('div');
  viewer.className = 'certificate-lightbox';
  viewer.hidden = true;
  viewer.setAttribute('role', 'dialog');
  viewer.setAttribute('aria-modal', 'true');
  viewer.setAttribute('aria-label', 'Certificate gallery');
  viewer.innerHTML = '<button class="certificate-lightbox__close" type="button" aria-label="Close certificate gallery">×</button>' +
    '<button class="certificate-lightbox__previous" type="button" aria-label="Previous certificate">←</button>' +
    '<img class="certificate-lightbox__image" src="" width="1000" height="800" alt="">' +
    '<button class="certificate-lightbox__next" type="button" aria-label="Next certificate">→</button>';
  document.body.appendChild(viewer);

  const image = viewer.querySelector('.certificate-lightbox__image');
  const closeButton = viewer.querySelector('.certificate-lightbox__close');
  const previousButton = viewer.querySelector('.certificate-lightbox__previous');
  const nextButton = viewer.querySelector('.certificate-lightbox__next');
  let activeLinks = [];
  let activeIndex = 0;
  let returnFocus = null;

  const show = function (index) {
    if (!activeLinks.length) return;
    activeIndex = (index + activeLinks.length) % activeLinks.length;
    const link = activeLinks[activeIndex];
    const thumbnail = link.querySelector('img');
    image.src = link.href;
    image.alt = thumbnail ? thumbnail.alt : 'Certificate';
  };
  const close = function () {
    viewer.hidden = true;
    document.body.classList.remove('has-certificate-lightbox');
    if (returnFocus) returnFocus.focus();
  };

  groups.forEach(function (group) {
    const links = Array.from(group.querySelectorAll('[data-certificate-lightbox]'));
    links.forEach(function (link, index) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        activeLinks = links;
        returnFocus = link;
        show(index);
        viewer.hidden = false;
        document.body.classList.add('has-certificate-lightbox');
        closeButton.focus();
      });
    });
  });

  closeButton.addEventListener('click', close);
  previousButton.addEventListener('click', function () { show(activeIndex - 1); });
  nextButton.addEventListener('click', function () { show(activeIndex + 1); });
  viewer.addEventListener('click', function (event) { if (event.target === viewer) close(); });
  document.addEventListener('keydown', function (event) {
    if (viewer.hidden) return;
    if (event.key === 'Escape') { event.preventDefault(); close(); }
    if (event.key === 'ArrowLeft') { event.preventDefault(); show(activeIndex - 1); }
    if (event.key === 'ArrowRight') { event.preventDefault(); show(activeIndex + 1); }
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
    const mobileTrack = window.matchMedia('(max-width: 850px)');
    const updateTrackFocus = function () {
      track.tabIndex = mobileTrack.matches ? 0 : -1;
    };
    updateTrackFocus();
    mobileTrack.addEventListener('change', updateTrackFocus);
    track.addEventListener('keydown', function (event) {
      if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
      event.preventDefault();
      track.scrollBy({ left: (event.key === 'ArrowRight' ? 1 : -1) * Math.max(260, track.clientWidth * 0.8), behavior: 'smooth' });
    });
  });

  document.querySelectorAll('.career-review-more').forEach(function (button) {
    button.addEventListener('click', function () {
      const card = button.closest('blockquote');
      const expanded = button.getAttribute('aria-expanded') === 'true';
      button.setAttribute('aria-expanded', String(!expanded));
      button.textContent = expanded ? 'View full version' : 'Show less';
      if (card) card.classList.toggle('is-expanded', !expanded);
    });
  });
}());
