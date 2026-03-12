/**
 * Instagarda — Main JS
 */
document.addEventListener('DOMContentLoaded', () => {
  // Header scroll effect
  const header = document.querySelector('.ig-header');
  if (header) {
    const onScroll = () => {
      header.classList.toggle('ig-header--scrolled', window.scrollY > 50);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Desktop dropdown: hover + click toggle
  document.querySelectorAll('.ig-nav__dropdown').forEach(dropdown => {
    const btn = dropdown.querySelector('.ig-nav__link');
    // Hover open/close
    dropdown.addEventListener('mouseenter', () => dropdown.classList.add('is-open'));
    dropdown.addEventListener('mouseleave', () => dropdown.classList.remove('is-open'));
    // Click toggle (for touch/trackpad)
    if (btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        const wasOpen = dropdown.classList.contains('is-open');
        document.querySelectorAll('.ig-nav__dropdown.is-open').forEach(d => d.classList.remove('is-open'));
        if (!wasOpen) dropdown.classList.add('is-open');
      });
    }
  });
  // Close dropdowns when clicking outside
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.ig-nav__dropdown')) {
      document.querySelectorAll('.ig-nav__dropdown.is-open').forEach(d => d.classList.remove('is-open'));
    }
  });

  // Mobile menu toggle
  const hamburger = document.getElementById('igMenuToggle');
  const mobileMenu = document.getElementById('igMobileMenu');
  if (hamburger && mobileMenu) {
    const openIcon = hamburger.querySelector('.ig-header__hamburger-icon--open');
    const closeIcon = hamburger.querySelector('.ig-header__hamburger-icon--close');
    hamburger.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('is-open');
      hamburger.setAttribute('aria-expanded', isOpen);
      if (openIcon) openIcon.style.display = isOpen ? 'none' : '';
      if (closeIcon) closeIcon.style.display = isOpen ? '' : 'none';
    });
    // Close on link click
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('is-open');
        if (openIcon) openIcon.style.display = '';
        if (closeIcon) closeIcon.style.display = 'none';
      });
    });
    // Mobile accordion submenus
    mobileMenu.querySelectorAll('.ig-mobile-menu__heading').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const target = document.getElementById(btn.dataset.toggle);
        if (target) {
          e.preventDefault();
          btn.classList.toggle('is-open');
          target.classList.toggle('is-open');
        }
      });
    });
  }

  // Language switcher toggle
  const langSwitcher = document.querySelector('.ig-lang-switcher');
  if (langSwitcher) {
    const langBtn = langSwitcher.querySelector('.ig-header__lang-btn');
    langBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      langSwitcher.classList.toggle('is-open');
      langBtn.setAttribute('aria-expanded', langSwitcher.classList.contains('is-open'));
    });
    document.addEventListener('click', () => langSwitcher.classList.remove('is-open'));
  }

  // Search overlay
  const searchToggle = document.getElementById('igSearchToggle');
  const searchOverlay = document.getElementById('igSearchOverlay');
  const searchClose = document.getElementById('igSearchClose');
  const searchInput = document.getElementById('igSearchInput');
  if (searchToggle && searchOverlay) {
    searchToggle.addEventListener('click', () => {
      searchOverlay.classList.add('is-open');
      setTimeout(() => searchInput && searchInput.focus(), 100);
    });
    if (searchClose) {
      searchClose.addEventListener('click', () => {
        searchOverlay.classList.remove('is-open');
      });
    }
    searchOverlay.addEventListener('click', (e) => {
      if (e.target === searchOverlay) searchOverlay.classList.remove('is-open');
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && searchOverlay.classList.contains('is-open')) {
        searchOverlay.classList.remove('is-open');
      }
    });
  }

  // Hero CTA tab switching
  const heroCtas = document.querySelectorAll('.ig-hero__cta');
  const heroGroups = document.querySelectorAll('.ig-hero__suggestion-group');
  heroCtas.forEach(cta => {
    cta.addEventListener('click', () => {
      heroCtas.forEach(c => {
        c.classList.remove('ig-hero__cta--active');
        c.setAttribute('aria-selected', 'false');
      });
      cta.classList.add('ig-hero__cta--active');
      cta.setAttribute('aria-selected', 'true');
      const tab = cta.dataset.tab;
      heroGroups.forEach(g => {
        g.classList.toggle('is-active', g.dataset.group === tab);
      });
    });
  });

  // Hero AI bar → opens Garda AI chat with query
  const heroAIInput = document.getElementById('igHeroAI');
  const heroAISend = document.getElementById('igHeroAISend');
  if (heroAIInput && heroAISend) {
    const sendHeroQuery = () => {
      const q = heroAIInput.value.trim();
      if (!q) return;
      // Open chat and send the query
      if (window.toggleGardaChat) window.toggleGardaChat();
      // Small delay to let panel open, then send message
      setTimeout(() => {
        const chatInput = document.getElementById('gcInput');
        const chatForm = document.getElementById('gcForm');
        if (chatInput && chatForm) {
          chatInput.value = q;
          chatForm.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
        }
      }, 350);
      heroAIInput.value = '';
    };
    heroAISend.addEventListener('click', sendHeroQuery);
    heroAIInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') { e.preventDefault(); sendHeroQuery(); }
    });
  }


  // Destinations carousel with auto-scroll
  const destTrack = document.getElementById('igDestTrack');
  const destPrev = document.getElementById('igDestPrev');
  const destNext = document.getElementById('igDestNext');
  if (destTrack && destPrev && destNext) {
    const scrollAmt = 226;
    let autoScrollTimer = null;

    const updateBtns = () => {
      destPrev.disabled = destTrack.scrollLeft <= 0;
      destNext.disabled = destTrack.scrollLeft >= destTrack.scrollWidth - destTrack.clientWidth - 1;
    };

    const autoScroll = () => {
      const atEnd = destTrack.scrollLeft >= destTrack.scrollWidth - destTrack.clientWidth - 1;
      if (atEnd) {
        destTrack.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        destTrack.scrollBy({ left: scrollAmt, behavior: 'smooth' });
      }
    };

    const startAuto = () => {
      stopAuto();
      autoScrollTimer = setInterval(autoScroll, 2500);
    };
    const stopAuto = () => {
      if (autoScrollTimer) { clearInterval(autoScrollTimer); autoScrollTimer = null; }
    };

    destPrev.addEventListener('click', () => {
      stopAuto();
      destTrack.scrollBy({ left: -scrollAmt, behavior: 'smooth' });
      startAuto();
    });
    destNext.addEventListener('click', () => {
      stopAuto();
      destTrack.scrollBy({ left: scrollAmt, behavior: 'smooth' });
      startAuto();
    });

    // Pause on hover/touch, resume on leave
    destTrack.addEventListener('mouseenter', stopAuto);
    destTrack.addEventListener('mouseleave', startAuto);
    destTrack.addEventListener('touchstart', stopAuto, { passive: true });
    destTrack.addEventListener('touchend', () => setTimeout(startAuto, 3000), { passive: true });

    destTrack.addEventListener('scroll', updateBtns, { passive: true });
    updateBtns();
    startAuto();
  }

  // Blog carousel with auto-scroll
  const blogTrack = document.getElementById('igBlogTrack');
  const blogPrev = document.getElementById('igBlogPrev');
  const blogNext = document.getElementById('igBlogNext');
  if (blogTrack && blogPrev && blogNext) {
    const blogScrollAmt = 360;
    let blogAutoTimer = null;

    const updateBlogBtns = () => {
      blogPrev.disabled = blogTrack.scrollLeft <= 0;
      blogNext.disabled = blogTrack.scrollLeft >= blogTrack.scrollWidth - blogTrack.clientWidth - 1;
    };

    const blogAutoScroll = () => {
      const atEnd = blogTrack.scrollLeft >= blogTrack.scrollWidth - blogTrack.clientWidth - 1;
      if (atEnd) {
        blogTrack.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        blogTrack.scrollBy({ left: blogScrollAmt, behavior: 'smooth' });
      }
    };

    const startBlogAuto = () => { stopBlogAuto(); blogAutoTimer = setInterval(blogAutoScroll, 3000); };
    const stopBlogAuto = () => { if (blogAutoTimer) { clearInterval(blogAutoTimer); blogAutoTimer = null; } };

    blogPrev.addEventListener('click', () => { stopBlogAuto(); blogTrack.scrollBy({ left: -blogScrollAmt, behavior: 'smooth' }); startBlogAuto(); });
    blogNext.addEventListener('click', () => { stopBlogAuto(); blogTrack.scrollBy({ left: blogScrollAmt, behavior: 'smooth' }); startBlogAuto(); });

    blogTrack.addEventListener('mouseenter', stopBlogAuto);
    blogTrack.addEventListener('mouseleave', startBlogAuto);
    blogTrack.addEventListener('touchstart', stopBlogAuto, { passive: true });
    blogTrack.addEventListener('touchend', () => setTimeout(startBlogAuto, 3000), { passive: true });

    blogTrack.addEventListener('scroll', updateBlogBtns, { passive: true });
    updateBlogBtns();
    startBlogAuto();
  }

  // Reels carousel auto-scroll
  const reelsTrack = document.getElementById('igReelsTrack');
  if (reelsTrack) {
    const reelScrollAmt = 276;
    let reelTimer = null;
    const reelAutoScroll = () => {
      if (reelsTrack.scrollLeft >= reelsTrack.scrollWidth - reelsTrack.clientWidth - 1) {
        reelsTrack.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        reelsTrack.scrollBy({ left: reelScrollAmt, behavior: 'smooth' });
      }
    };
    const startReelAuto = () => { stopReelAuto(); reelTimer = setInterval(reelAutoScroll, 2500); };
    const stopReelAuto = () => { if (reelTimer) { clearInterval(reelTimer); reelTimer = null; } };

    reelsTrack.addEventListener('mouseenter', stopReelAuto);
    reelsTrack.addEventListener('mouseleave', startReelAuto);
    reelsTrack.addEventListener('touchstart', stopReelAuto, { passive: true });
    reelsTrack.addEventListener('touchend', () => setTimeout(startReelAuto, 3000), { passive: true });
    startReelAuto();
  }

  // -------------------------------------------------------
  // Scroll reveal animations with staggered children
  // -------------------------------------------------------
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const reveals = document.querySelectorAll('.ig-reveal');
  if (reveals.length > 0 && 'IntersectionObserver' in window) {
    // Tag child cards/items for staggered animation
    reveals.forEach(section => {
      const children = section.querySelectorAll(
        '.ig-dest-card, .ig-blog-card, .ig-vivi-card, .ig-featured-card, .ig-social-stat, .ig-reel, .ig-social-cta'
      );
      children.forEach((child, i) => {
        child.classList.add('ig-reveal-child');
        if (!prefersReducedMotion) {
          child.style.transitionDelay = (i * 0.08) + 's';
        }
      });
    });

    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    reveals.forEach(el => revealObserver.observe(el));
  }

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const target = document.querySelector(anchor.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });


  // -------------------------------------------------------
  // Animated counters for social stats
  // -------------------------------------------------------
  const statNumbers = document.querySelectorAll('.ig-social-stat__number');
  if (statNumbers.length > 0 && 'IntersectionObserver' in window) {
    const parseStatValue = (text) => {
      text = text.trim();
      const hasK = text.toUpperCase().endsWith('K');
      const num = parseFloat(text.replace(/[Kk]/g, ''));
      return { value: num, suffix: hasK ? 'K' : '', hasDecimal: text.includes('.') };
    };

    const animateCounter = (el, parsed) => {
      const duration = 2000;
      const startTime = performance.now();
      const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);

      const tick = (now) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easedProgress = easeOutCubic(progress);
        const current = easedProgress * parsed.value;

        if (parsed.hasDecimal) {
          el.textContent = current.toFixed(1) + parsed.suffix;
        } else {
          el.textContent = Math.floor(current) + parsed.suffix;
        }

        if (progress < 1) {
          requestAnimationFrame(tick);
        } else {
          // Ensure final value is exact
          el.textContent = (parsed.hasDecimal ? parsed.value.toFixed(1) : String(parsed.value)) + parsed.suffix;
        }
      };

      requestAnimationFrame(tick);
    };

    // Store original values and set to 0
    statNumbers.forEach(el => {
      el.dataset.target = el.textContent.trim();
      if (!prefersReducedMotion) {
        el.textContent = '0';
      }
    });

    if (!prefersReducedMotion) {
      const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const el = entry.target;
            const parsed = parseStatValue(el.dataset.target);
            animateCounter(el, parsed);
            counterObserver.unobserve(el);
          }
        });
      }, { threshold: 0.3 });
      statNumbers.forEach(el => counterObserver.observe(el));
    }
  }

  // -------------------------------------------------------
  // 3D Tilt effect on Vivi Cards (desktop only)
  // -------------------------------------------------------
  if (!prefersReducedMotion && window.innerWidth >= 768) {
    const viviCards = document.querySelectorAll('.ig-vivi-card');
    viviCards.forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -5;
        const rotateY = ((x - centerX) / centerX) * 5;
        card.classList.add('ig-tilt-active');
        card.style.transform = 'rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)';
      });

      card.addEventListener('mouseleave', () => {
        card.classList.remove('ig-tilt-active');
        card.style.transform = '';
      });
    });
  }

  // -------------------------------------------------------
  // Parallax on Hero Video (desktop only)
  // -------------------------------------------------------
  if (!prefersReducedMotion && window.innerWidth >= 768) {
    const heroBg = document.querySelector('.ig-hero__bg');
    if (heroBg) {
      const heroSection = document.querySelector('.ig-hero');
      let ticking = false;
      const onParallaxScroll = () => {
        if (!ticking) {
          requestAnimationFrame(() => {
            const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
            if (window.scrollY < heroBottom) {
              const translateY = Math.min(window.scrollY * 0.25, 50);
              heroBg.style.transform = 'translateY(' + translateY + 'px)';
            }
            ticking = false;
          });
          ticking = true;
        }
      };
      window.addEventListener('scroll', onParallaxScroll, { passive: true });
    }
  }

  // -------------------------------------------------------
  // Back to Top Button
  // -------------------------------------------------------
  const backToTopBtn = document.getElementById('igBackToTop');
  if (backToTopBtn) {
    const toggleBackToTop = () => {
      backToTopBtn.classList.toggle('is-visible', window.scrollY > 500);
    };
    window.addEventListener('scroll', toggleBackToTop, { passive: true });
    toggleBackToTop();

    backToTopBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // -------------------------------------------------------
  // Lazy-load image fade-in
  // -------------------------------------------------------
  if ('IntersectionObserver' in window) {
    const allImages = document.querySelectorAll('img');
    const heroSection = document.querySelector('.ig-hero');

    allImages.forEach(img => {
      // Skip hero video/images and already-loaded images
      if (heroSection && heroSection.contains(img)) return;
      if (img.complete && img.naturalWidth > 0) return;

      img.classList.add('ig-img-lazy');

      if (prefersReducedMotion) {
        img.classList.add('ig-img-loaded');
        return;
      }
    });

    const imgObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          // Small delay to let the image paint, then fade in
          const reveal = () => {
            img.classList.add('ig-img-loaded');
            imgObserver.unobserve(img);
          };
          if (img.complete) {
            reveal();
          } else {
            img.addEventListener('load', reveal, { once: true });
            // Fallback if load doesn't fire
            setTimeout(reveal, 2000);
          }
        }
      });
    }, { rootMargin: '50px 0px' });

    document.querySelectorAll('.ig-img-lazy:not(.ig-img-loaded)').forEach(img => {
      imgObserver.observe(img);
    });
  }

  // -------------------------------------------------------
  // POI Carousel (Apple-style) + Panel open/close
  // -------------------------------------------------------
  const poiTrack = document.getElementById('igPoiTrack');
  const poiPrev = document.getElementById('igPoiPrev');
  const poiNext = document.getElementById('igPoiNext');
  if (poiTrack) {
    const scrollAmt = 320;
    const updatePoiBtns = () => {
      if (poiPrev) poiPrev.disabled = poiTrack.scrollLeft <= 0;
      if (poiNext) poiNext.disabled = poiTrack.scrollLeft >= poiTrack.scrollWidth - poiTrack.clientWidth - 1;
    };
    if (poiPrev) poiPrev.addEventListener('click', () => { poiTrack.scrollBy({ left: -scrollAmt, behavior: 'smooth' }); });
    if (poiNext) poiNext.addEventListener('click', () => { poiTrack.scrollBy({ left: scrollAmt, behavior: 'smooth' }); });
    poiTrack.addEventListener('scroll', updatePoiBtns, { passive: true });
    updatePoiBtns();

    // Open panel on card click or "+" button
    const openPoiPanel = (index) => {
      const panel = document.getElementById('igPoiPanel' + index);
      if (!panel) return;
      panel.classList.add('is-open');
      panel.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    };
    const closePoiPanel = (panel) => {
      panel.classList.remove('is-open');
      panel.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    };

    poiTrack.querySelectorAll('.ig-poi-card').forEach(card => {
      card.addEventListener('click', () => openPoiPanel(card.dataset.index));
    });
    poiTrack.querySelectorAll('.ig-poi-card__expand').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        openPoiPanel(btn.dataset.poi);
      });
    });

    // Close panels
    document.querySelectorAll('.ig-poi-panel__close').forEach(btn => {
      btn.addEventListener('click', () => closePoiPanel(btn.closest('.ig-poi-panel')));
    });
    document.querySelectorAll('.ig-poi-panel').forEach(panel => {
      panel.addEventListener('click', (e) => {
        if (e.target === panel) closePoiPanel(panel);
      });
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        document.querySelectorAll('.ig-poi-panel.is-open').forEach(p => closePoiPanel(p));
      }
    });
  }

  // Contact form (simple frontend handling)
  const contactForm = document.querySelector('.ig-contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = contactForm.querySelector('button[type="submit"]');
      const originalHTML = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = '<span style="display:inline-block;width:20px;height:20px;border:2px solid rgba(255,255,255,0.3);border-top-color:white;border-radius:50%;animation:spin 0.8s linear infinite"></span>';
      setTimeout(() => {
        const card = contactForm.closest('.ig-contact-form-card');
        if (card) {
          card.innerHTML = '<div style="text-align:center;padding:48px 24px"><div style="width:64px;height:64px;border-radius:50%;background:rgba(0,122,255,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#007AFF" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><h3 style="font-size:1.5rem;font-weight:700;color:var(--ig-text);margin-bottom:8px">Messaggio inviato!</h3><p style="color:var(--ig-text-muted)">Grazie per averci scritto. Ti risponderemo il prima possibile.</p></div>';
        }
      }, 1200);
    });
  }

  // Newsletter form (simple frontend handling)
  const nlForm = document.querySelector('.ig-newsletter__form');
  if (nlForm) {
    nlForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = nlForm.querySelector('.ig-newsletter__submit');
      const input = nlForm.querySelector('.ig-newsletter__input');
      if (btn && input && input.value) {
        btn.textContent = '';
        btn.style.position = 'relative';
        btn.insertAdjacentHTML('afterbegin', '<span style="display:inline-block;width:20px;height:20px;border:2px solid rgba(0,122,255,0.3);border-top-color:var(--ig-primary);border-radius:50%;animation:spin 0.8s linear infinite"></span>');
        setTimeout(() => {
          const card = nlForm.closest('.ig-newsletter__card');
          if (card) {
            card.innerHTML = '<div style="text-align:center;padding:32px 0"><div style="width:64px;height:64px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto 16px"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><h3 style="font-size:1.5rem;font-weight:700;color:white;margin-bottom:8px">Iscrizione completata!</h3><p style="color:rgba(255,255,255,.8)">Grazie! Riceverai presto la nostra newsletter.</p></div>';
          }
        }, 1000);
      }
    });
  }
});
