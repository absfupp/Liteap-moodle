/**
 * @module theme_liteap/Myschool
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


define([], function() {
  'use strict';

  /**
   * Apply .scrolled class to body when scrolling.
   */
  function toggleScrolled() {
    const body = document.querySelector('body');
    const header = document.querySelector('#header');

    if (!header) {
      return;
    }

    const hasSticky = header.classList.contains('scroll-up-sticky') ||
      header.classList.contains('sticky-top') ||
      header.classList.contains('fixed-top');

    if (!hasSticky) {
      return;
    }

    if (window.scrollY > 100) {
      body.classList.add('scrolled');
    } else {
      body.classList.remove('scrolled');
    }
  }

  /**
   * Initialize scroll behavior.
   */
  function initScroll() {
    document.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);
  }

  /**
   * Initialize mobile navigation toggle.
   */
  function initMobileNav() {
    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

    function mobileNavToggle() {
      document.body.classList.toggle('mobile-nav-active');
      if (mobileNavToggleBtn) {
        mobileNavToggleBtn.classList.toggle('bi-list');
        mobileNavToggleBtn.classList.toggle('bi-x');
      }
    }

    if (mobileNavToggleBtn) {
      mobileNavToggleBtn.addEventListener('click', mobileNavToggle);
    }

    document.querySelectorAll('#navmenu a').forEach(link => {
      link.addEventListener('click', () => {
        if (document.body.classList.contains('mobile-nav-active')) {
          mobileNavToggle();
        }
      });
    });

    document.querySelectorAll('.navmenu .toggle-dropdown').forEach(toggle => {
      toggle.addEventListener('click', e => {
        e.preventDefault();
        const parent = toggle.parentNode;
        const next = parent.nextElementSibling;
        parent.classList.toggle('active');
        if (next) {
          next.classList.toggle('dropdown-active');
        }
        e.stopImmediatePropagation();
      });
    });
  }

  /**
   * Initialize preloader removal.
   */
  function initPreloader() {
    const preloader = document.querySelector('#preloader');
    if (preloader) {
      window.addEventListener('load', () => {
        preloader.remove();
      });
    }
  }

  /**
   * Initialize scroll-top button.
   */
  function initScrollTop() {
    const scrollTop = document.querySelector('.scroll-top');

    function toggleScrollTop() {
      if (!scrollTop) {
        return;
      }
      if (window.scrollY > 100) {
        scrollTop.classList.add('active');
      } else {
        scrollTop.classList.remove('active');
      }
    }

    if (scrollTop) {
      scrollTop.addEventListener('click', e => {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    window.addEventListener('load', toggleScrollTop);
    document.addEventListener('scroll', toggleScrollTop);
  }

  /**
   * Initialize Swiper sliders.
   */
  function initSwiper() {
    document.querySelectorAll('.init-swiper').forEach(swiperElement => {
      const configElement = swiperElement.querySelector('.swiper-config');
      if (!configElement) {
        return;
      }

      let config;
      try {
        config = JSON.parse(configElement.textContent.trim());
      } catch (err) {
        // console.error('Invalid Swiper config JSON', err);
        return;
      }

      if (swiperElement.classList.contains('swiper-tab')) {
        if (window.initSwiperWithCustomPagination) {
          window.initSwiperWithCustomPagination(swiperElement, config);
        }
      } else if (window.Swiper) {
        new window.Swiper(swiperElement, config); // eslint-disable-line no-new
      }
    });
  }

  /**
   * Initialize external libraries (PureCounter, GLightbox).
   */
  function initExternalLibs() {
    if (window.PureCounter) {
      // eslint-disable-next-line no-new
      new window.PureCounter();
    }

    if (window.GLightbox) {
      window.GLightbox({ selector: '.glightbox' });
    }
  }

  /**
   * Initialize everything.
   */
  function init() {
    initScroll();
    initMobileNav();
    initPreloader();
    initScrollTop();
    initSwiper();
    initExternalLibs();
  }

  return {
    init: init
  };
});
