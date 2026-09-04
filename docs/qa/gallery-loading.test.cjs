// Run: node docs/qa/gallery-loading.test.cjs (no browser or npm dependencies).
const { readFileSync } = require('node:fs');
const { runInNewContext } = require('node:vm');
const assert = require('node:assert/strict');
const source = readFileSync(new URL('../../wordpress/wp-content/themes/neurocoaching/assets/js/navigation.js', `file://${__filename}`), 'utf8');

function fixture(withObserver) {
  const images = Array.from({ length: 4 }, () => ({ loading: 'lazy', complete: true }));
  const slides = images.map((image, i) => ({ hidden: i !== 0, querySelector: () => image }));
  const dots = images.map((_, i) => ({ current: String(i === 0), click: null,
    setAttribute(name, value) { this.current = value; },
    addEventListener(name, callback) { this[name] = callback; },
  }));
  const carousel = {
    querySelectorAll: selector => selector === '[data-carousel-slide]' ? slides : dots,
    querySelector: () => null, addEventListener() {},
    classList: { contains: () => false },
  };
  let intersect, disconnected = false;
  class Observer {
    constructor(callback) { intersect = callback; }
    observe() {}
    disconnect() { disconnected = true; }
  }
  const context = {
    document: { querySelector: () => null, querySelectorAll: selector => selector === '[data-carousel]' ? [carousel] : [] },
    window: { addEventListener() {} },
  };
  if (withObserver) {
    context.window.IntersectionObserver = Observer;
    context.IntersectionObserver = Observer;
  }
  runInNewContext(source, context);
  assert.deepEqual(images.map(i => i.loading), ['lazy', 'lazy', 'lazy', 'lazy']);
  assert.equal(dots[0].current, 'true');
  assert.equal(slides[0].hidden, false);
  if (withObserver) {
    intersect([{ isIntersecting: false }]);
    assert.equal(images[0].loading, 'lazy');
    intersect([{ isIntersecting: true }]);
    assert.deepEqual(images.map(i => i.loading), ['eager', 'eager', 'lazy', 'lazy']);
    assert.equal(disconnected, true);
  }
  dots[2].click();
  assert.equal(dots[2].current, 'true');
  assert.equal(slides[2].hidden, false);
  assert.equal(slides[0].hidden, true);
  assert.equal(images[2].loading, 'eager');
  assert.equal(images[3].loading, 'eager');
}
fixture(true);
fixture(false);
console.log('PASS: initial lazy loading, near-viewport prefetch, dot navigation, no-observer fallback');
