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
    '<img class="certificate-lightbox__image" width="1000" height="800" alt="">' +
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
    const pagination = carousel.querySelector('[data-carousel-pagination]');
    let active = 0;
    let touchStart = null;
    const fitPagination = function () {
      if (!pagination || !dots.length || !carousel.classList.contains('nc-gallery--many')) return;
      pagination.style.width = '';
      const availableWidth = pagination.clientWidth;
      if (pagination.scrollWidth <= availableWidth) return;
      const dotWidth = dots[0].offsetWidth;
      const paginationStyle = window.getComputedStyle(pagination);
      const gap = parseFloat(paginationStyle.columnGap || paginationStyle.gap) || 0;
      let visibleDots = Math.max(1, Math.floor((availableWidth + gap) / (dotWidth + gap)));
      if (visibleDots > 1 && visibleDots % 2 === 0) visibleDots -= 1;
      const fittedWidth = Math.min(availableWidth, (visibleDots * dotWidth) + ((visibleDots - 1) * gap));
      pagination.style.width = fittedWidth + 'px';
    };
    const preload = function () {
      [active, (active + 1) % slides.length].forEach(function (slideIndex) {
        const slideImage = slides[slideIndex] ? slides[slideIndex].querySelector('img') : null;
        if (slideImage) slideImage.loading = 'eager';
      });
    };
    const show = function (index) {
      if (!slides.length) return;
      const nextIndex = (index + slides.length) % slides.length;
      const nextImage = slides[nextIndex].querySelector('img');
      if (nextImage) nextImage.loading = 'eager';
      const apply = function () {
        active = nextIndex;
        slides.forEach(function (slide, slideIndex) { slide.hidden = slideIndex !== active; });
        dots.forEach(function (dot, dotIndex) { dot.setAttribute('aria-current', String(dotIndex === active)); });
        if (pagination && dots[active] && pagination.scrollWidth > pagination.clientWidth) {
          pagination.scrollLeft = dots[active].offsetLeft - ((pagination.clientWidth - dots[active].offsetWidth) / 2);
        }
        preload();
      };
      if (nextImage && !nextImage.complete) {
        nextImage.loading = 'eager';
        nextImage.addEventListener('load', apply, { once: true });
        return;
      }
      apply();
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
    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(function (entries) {
        if (!entries.some(function (entry) { return entry.isIntersecting; })) return;
        preload();
        observer.disconnect();
      }, { rootMargin: '400px 0px' });
      observer.observe(carousel);
    }
    fitPagination();
    window.addEventListener('resize', fitPagination);
    // PHP already renders slide 0 and its active dot. Calling show(0) here
    // eagerly downloads two below-fold photos and defeats the observer above.
    // Keep native lazy loading until near the gallery or a user interaction.
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

  document.querySelectorAll('.career-reviews').forEach(function (section) {
    const track = section.querySelector('.career-review-track');
    const previous = section.querySelector('[data-review-previous]');
    const next = section.querySelector('[data-review-next]');
    if (!track || !previous || !next) return;
    const step = function () {
      const card = track.querySelector('blockquote');
      const gap = parseFloat(window.getComputedStyle(track).gap) || 0;
      return card ? card.getBoundingClientRect().width + gap : Math.max(260, track.clientWidth * 0.8);
    };
    const update = function () {
      previous.disabled = track.scrollLeft <= 2;
      next.disabled = track.scrollLeft >= track.scrollWidth - track.clientWidth - 2;
    };
    previous.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
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
