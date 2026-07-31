/**
 * Hausmeister Theme — main JavaScript.
 */
(function () {
	'use strict';

	/* Mobile navigation */
	var navToggle = document.querySelector('.nav-toggle');
	var navClose = document.querySelector('.mobile-nav-close');
	var navDrawer = document.querySelector('.mobile-nav-drawer');
	var navOverlay = document.querySelector('.mobile-nav-overlay');

	function openNav() {
		if (!navDrawer || !navOverlay) return;
		navDrawer.classList.add('is-open');
		navOverlay.classList.add('is-visible');
		document.body.style.overflow = 'hidden';
		if (navToggle) navToggle.setAttribute('aria-expanded', 'true');
	}

	function closeNav() {
		if (!navDrawer || !navOverlay) return;
		navDrawer.classList.remove('is-open');
		navOverlay.classList.remove('is-visible');
		document.body.style.overflow = '';
		if (navToggle) navToggle.setAttribute('aria-expanded', 'false');
	}

	if (navToggle) navToggle.addEventListener('click', openNav);
	if (navClose) navClose.addEventListener('click', closeNav);
	if (navOverlay) navOverlay.addEventListener('click', closeNav);

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			if (document.body.classList.contains('gallery-lightbox-open')) return;
			closeNav();
		}
	});

	/* Services mega menu */
	var megaItems = document.querySelectorAll('.menu-item-has-mega');
	var desktopMegaQuery = window.matchMedia('(min-width: 992px)');

	function closeMegaItem(item) {
		if (!item) return;
		item.classList.remove('is-open');
		var trigger = item.querySelector('.nav-link--mega');
		if (trigger) trigger.setAttribute('aria-expanded', 'false');
	}

	function closeAllMegaMenus(except) {
		megaItems.forEach(function (item) {
			if (item !== except) closeMegaItem(item);
		});
	}

	megaItems.forEach(function (item) {
		var trigger = item.querySelector('.nav-link--mega');
		var panel = item.querySelector('.mega-menu-panel');
		if (!trigger || !panel) return;

		function openMega() {
			closeAllMegaMenus(item);
			item.classList.add('is-open');
			trigger.setAttribute('aria-expanded', 'true');
		}

		function toggleMegaMobile(e) {
			var href = trigger.getAttribute('href') || '';
			if (href.charAt(0) === '#') {
				e.preventDefault();
			}
			if (desktopMegaQuery.matches) return;
			var isOpen = item.classList.contains('is-open');
			closeAllMegaMenus();
			if (!isOpen) {
				item.classList.add('is-open');
				trigger.setAttribute('aria-expanded', 'true');
			} else {
				closeMegaItem(item);
			}
		}

		if (desktopMegaQuery.matches) {
			item.addEventListener('mouseenter', openMega);
			item.addEventListener('mouseleave', function () {
				closeMegaItem(item);
			});
			trigger.addEventListener('focus', openMega);
		}

		trigger.addEventListener('click', toggleMegaMobile);

		panel.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				closeMegaItem(item);
				closeNav();
			});
		});
	});

	document.addEventListener('click', function (e) {
		if (!e.target.closest('.menu-item-has-mega')) {
			closeAllMegaMenus();
		}
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') closeAllMegaMenus();
	});

	/* Lightweight scroll reveals (stats + services) */
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var revealRoots = document.querySelectorAll('[data-reveal-root]');

	function showRevealRoot(root) {
		root.classList.add('is-visible');
	}

	if (reduceMotion) {
		revealRoots.forEach(showRevealRoot);
	} else if (revealRoots.length && 'IntersectionObserver' in window) {
		var revealObserver = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) return;
				showRevealRoot(entry.target);
				revealObserver.unobserve(entry.target);
			});
		}, { threshold: 0.18, rootMargin: '0px 0px -8% 0px' });

		revealRoots.forEach(function (root) {
			revealObserver.observe(root);
		});
	} else {
		revealRoots.forEach(showRevealRoot);
	}

	/* Animated stats counter */
	function animateCounter(el) {
		var target = parseInt(el.getAttribute('data-target'), 10);
		var suffix = el.getAttribute('data-suffix') || '';
		var prefix = el.getAttribute('data-prefix') || '';
		if (isNaN(target)) return;

		var duration = 1800;
		var start = null;

		function step(timestamp) {
			if (!start) start = timestamp;
			var progress = Math.min((timestamp - start) / duration, 1);
			var eased = 1 - Math.pow(1 - progress, 3);
			var current = Math.floor(eased * target);
			el.textContent = prefix + current + suffix;
			if (progress < 1) {
				window.requestAnimationFrame(step);
			} else {
				el.textContent = prefix + target + suffix;
			}
		}

		window.requestAnimationFrame(step);
	}

	var counters = document.querySelectorAll('[data-counter]');
	if (counters.length && 'IntersectionObserver' in window) {
		var observed = new WeakSet();
		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting && !observed.has(entry.target)) {
					observed.add(entry.target);
					animateCounter(entry.target);
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.4 });

		counters.forEach(function (el) {
			observer.observe(el);
		});
	} else {
		counters.forEach(animateCounter);
	}

	/* Why Us — pillar interaction + scroll reveal */
	var whySection = document.querySelector('[data-why-us]');
	if (whySection) {
		var pillars = whySection.querySelectorAll('[data-why-pillar]');
		var quoteText = whySection.querySelector('[data-why-quote-text]');

		function setActivePillar(pillar) {
			if (!pillar) return;
			pillars.forEach(function (p) {
				p.classList.remove('is-active');
				p.setAttribute('aria-selected', 'false');
			});
			pillar.classList.add('is-active');
			pillar.setAttribute('aria-selected', 'true');

			if (quoteText && pillar.getAttribute('data-quote')) {
				quoteText.classList.add('is-fading');
				window.setTimeout(function () {
					quoteText.textContent = pillar.getAttribute('data-quote');
					quoteText.classList.remove('is-fading');
				}, 160);
			}
		}

		pillars.forEach(function (pillar) {
			pillar.addEventListener('mouseenter', function () {
				setActivePillar(pillar);
			});
			pillar.addEventListener('focus', function () {
				setActivePillar(pillar);
			});
			pillar.addEventListener('click', function () {
				setActivePillar(pillar);
			});
		});

		if ('IntersectionObserver' in window) {
			var whyObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						whyObserver.unobserve(entry.target);
					}
				});
			}, { threshold: 0.15 });
			whyObserver.observe(whySection);
		} else {
			whySection.classList.add('is-visible');
		}
	}

	/* Before & After gallery */
	var baGallery = document.querySelector('[data-ba-gallery]');
	if (baGallery) {
		var activeDrag = null;

		function initBaSlider(slider) {
			var frame = slider.querySelector('[data-ba-frame]');
			var beforeLayer = slider.querySelector('[data-ba-before-layer]');
			var handle = slider.querySelector('[data-ba-handle]');
			var imgBefore = slider.querySelector('[data-ba-img-before]');
			var pos = 50;

			function setPos(percent) {
				pos = Math.max(5, Math.min(95, percent));
				if (beforeLayer) beforeLayer.style.width = pos + '%';
				if (handle) {
					handle.style.left = pos + '%';
					handle.setAttribute('aria-valuenow', String(Math.round(pos)));
				}
			}

			function syncWidth() {
				if (frame && imgBefore) {
					imgBefore.style.width = frame.offsetWidth + 'px';
				}
			}

			function moveFromEvent(e) {
				if (!frame) return;
				var rect = frame.getBoundingClientRect();
				var clientX = e.touches ? e.touches[0].clientX : e.clientX;
				setPos(((clientX - rect.left) / rect.width) * 100);
			}

			syncWidth();
			setPos(50);

			if (typeof ResizeObserver !== 'undefined' && frame) {
				var ro = new ResizeObserver(syncWidth);
				ro.observe(frame);
			} else {
				window.addEventListener('resize', syncWidth);
			}

			if (handle) {
				handle.addEventListener('keydown', function (e) {
					if (e.key === 'ArrowLeft') { setPos(pos - 5); e.preventDefault(); }
					if (e.key === 'ArrowRight') { setPos(pos + 5); e.preventDefault(); }
				});
			}

			if (frame) {
				frame.addEventListener('mousedown', function (e) {
					activeDrag = slider;
					moveFromEvent(e);
				});
				frame.addEventListener('touchstart', function (e) {
					activeDrag = slider;
					moveFromEvent(e);
				}, { passive: true });
			}

			slider._baSetPos = setPos;
			slider._baSync = syncWidth;
		}

		baGallery.querySelectorAll('[data-ba-slider]').forEach(initBaSlider);

		var baMoreBtn = baGallery.querySelector('[data-ba-more]');
		var baLessBtn = baGallery.querySelector('[data-ba-less]');
		var baExtras = baGallery.querySelectorAll('[data-ba-extra]');

		function setBaExpanded(expanded) {
			baExtras.forEach(function (card) {
				card.hidden = !expanded;
				card.classList.toggle('is-revealed', expanded);
				if (expanded) {
					var slider = card.querySelector('[data-ba-slider]');
					if (slider && slider._baSync) slider._baSync();
					if (slider && slider._baSetPos) slider._baSetPos(50);
				}
			});
			if (baMoreBtn) baMoreBtn.hidden = expanded;
			if (baLessBtn) baLessBtn.hidden = !expanded;
			if (expanded && baLessBtn) {
				baLessBtn.focus();
			} else if (!expanded && baMoreBtn) {
				baMoreBtn.focus();
				baGallery.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
			}
		}

		if (baMoreBtn) {
			baMoreBtn.addEventListener('click', function () {
				setBaExpanded(true);
			});
		}
		if (baLessBtn) {
			baLessBtn.addEventListener('click', function () {
				setBaExpanded(false);
			});
		}

		document.addEventListener('mousemove', function (e) {
			if (!activeDrag) return;
			var frame = activeDrag.querySelector('[data-ba-frame]');
			if (!frame) return;
			var rect = frame.getBoundingClientRect();
			activeDrag._baSetPos(((e.clientX - rect.left) / rect.width) * 100);
		});
		document.addEventListener('touchmove', function (e) {
			if (!activeDrag || !e.touches.length) return;
			var frame = activeDrag.querySelector('[data-ba-frame]');
			if (!frame) return;
			var rect = frame.getBoundingClientRect();
			activeDrag._baSetPos(((e.touches[0].clientX - rect.left) / rect.width) * 100);
		}, { passive: true });
		document.addEventListener('mouseup', function () { activeDrag = null; });
		document.addEventListener('touchend', function () { activeDrag = null; });
	}

	/* Work gallery lightbox + collapse after 3 rows */
	var workGallery = document.querySelector('[data-work-gallery]');
	if (workGallery) {
		var workGallerySection = workGallery.closest('[data-work-gallery-section]') || workGallery.parentElement;
		var galleryFigures = Array.prototype.slice.call(workGallery.querySelectorAll('.work-gallery__item'));
		var galleryTriggers = Array.prototype.slice.call(workGallery.querySelectorAll('[data-gallery-open]'));
		var galleryItems = galleryTriggers.map(function (btn) {
			var img = btn.querySelector('img');
			return {
				src: img ? img.currentSrc || img.src : '',
				alt: img ? img.alt : ''
			};
		}).filter(function (item) { return item.src; });

		var galleryMoreWrap = workGallerySection ? workGallerySection.querySelector('[data-gallery-more-wrap]') : null;
		var galleryMoreBtn = workGallerySection ? workGallerySection.querySelector('[data-gallery-more]') : null;
		var galleryLessBtn = workGallerySection ? workGallerySection.querySelector('[data-gallery-less]') : null;
		var galleryExpanded = false;
		var galleryResizeTimer = null;

		function getGalleryRowMetrics() {
			var styles = window.getComputedStyle(workGallery);
			var row = parseFloat(styles.gridAutoRows);
			var gap = parseFloat(styles.rowGap || styles.gap);
			if (!row || isNaN(row)) row = 160;
			if (!gap || isNaN(gap)) gap = 14;
			return { row: row, gap: gap, limit: (3 * row) + (2 * gap) };
		}

		function applyGalleryCollapse() {
			if (!galleryFigures.length) return;

			galleryFigures.forEach(function (item) {
				item.hidden = false;
				item.classList.remove('is-gallery-collapsed');
			});

			if (galleryExpanded) {
				if (galleryMoreWrap) galleryMoreWrap.hidden = false;
				if (galleryMoreBtn) galleryMoreBtn.hidden = true;
				if (galleryLessBtn) galleryLessBtn.hidden = false;
				return;
			}

			var metrics = getGalleryRowMetrics();
			var hasOverflow = false;

			/* Force layout, then hide items that start at/after row 4. */
			void workGallery.offsetHeight;

			galleryFigures.forEach(function (item) {
				var hide = item.offsetTop >= (metrics.limit - 1);
				item.hidden = hide;
				item.classList.toggle('is-gallery-collapsed', hide);
				if (hide) hasOverflow = true;
			});

			if (galleryMoreWrap) galleryMoreWrap.hidden = !hasOverflow;
			if (galleryMoreBtn) galleryMoreBtn.hidden = !hasOverflow;
			if (galleryLessBtn) galleryLessBtn.hidden = true;
		}

		function setGalleryExpanded(expanded) {
			galleryExpanded = expanded;
			applyGalleryCollapse();
			if (expanded && galleryLessBtn) {
				galleryLessBtn.focus();
			} else if (!expanded && galleryMoreBtn) {
				galleryMoreBtn.focus();
				if (workGallerySection) {
					workGallerySection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
				}
			}
		}

		if (galleryMoreBtn) {
			galleryMoreBtn.addEventListener('click', function () {
				setGalleryExpanded(true);
			});
		}
		if (galleryLessBtn) {
			galleryLessBtn.addEventListener('click', function () {
				setGalleryExpanded(false);
			});
		}

		window.addEventListener('resize', function () {
			window.clearTimeout(galleryResizeTimer);
			galleryResizeTimer = window.setTimeout(applyGalleryCollapse, 150);
		});

		window.setTimeout(applyGalleryCollapse, 0);
		if (document.fonts && document.fonts.ready) {
			document.fonts.ready.then(function () {
				applyGalleryCollapse();
			}).catch(function () {});
		}

		if (galleryItems.length) {
			var lightbox = document.createElement('div');
			lightbox.className = 'gallery-lightbox';
			lightbox.setAttribute('data-gallery-lightbox', '');
			lightbox.setAttribute('hidden', '');
			lightbox.setAttribute('role', 'dialog');
			lightbox.setAttribute('aria-modal', 'true');
			lightbox.setAttribute('aria-label', 'Galerie');
			lightbox.innerHTML =
				'<div class="gallery-lightbox__backdrop" data-gallery-close></div>' +
				'<div class="gallery-lightbox__dialog">' +
					'<button type="button" class="gallery-lightbox__close" data-gallery-close aria-label="Schließen">&times;</button>' +
					'<button type="button" class="gallery-lightbox__nav gallery-lightbox__nav--prev" data-gallery-prev aria-label="Vorheriges Bild">' +
						'<span aria-hidden="true">&#10094;</span>' +
					'</button>' +
					'<figure class="gallery-lightbox__figure">' +
						'<img class="gallery-lightbox__img" src="" alt="">' +
					'</figure>' +
					'<button type="button" class="gallery-lightbox__nav gallery-lightbox__nav--next" data-gallery-next aria-label="Nächstes Bild">' +
						'<span aria-hidden="true">&#10095;</span>' +
					'</button>' +
					'<p class="gallery-lightbox__counter" data-gallery-counter></p>' +
				'</div>';
			document.body.appendChild(lightbox);

			var lightboxImg = lightbox.querySelector('.gallery-lightbox__img');
			var lightboxCounter = lightbox.querySelector('[data-gallery-counter]');
			var lightboxIndex = 0;
			var lastFocus = null;
			var touchStartX = 0;

			function updateLightbox() {
				var item = galleryItems[lightboxIndex];
				if (!item || !lightboxImg) return;
				lightboxImg.src = item.src;
				lightboxImg.alt = item.alt || '';
				if (lightboxCounter) {
					lightboxCounter.textContent = (lightboxIndex + 1) + ' / ' + galleryItems.length;
				}
			}

			function openLightbox(index) {
				lightboxIndex = Math.max(0, Math.min(galleryItems.length - 1, index));
				updateLightbox();
				lastFocus = document.activeElement;
				lightbox.hidden = false;
				document.body.classList.add('gallery-lightbox-open');
				document.body.style.overflow = 'hidden';
				var closeBtn = lightbox.querySelector('.gallery-lightbox__close');
				if (closeBtn) closeBtn.focus();
			}

			function closeLightbox() {
				lightbox.hidden = true;
				document.body.classList.remove('gallery-lightbox-open');
				document.body.style.overflow = '';
				if (lightboxImg) lightboxImg.removeAttribute('src');
				if (lastFocus && typeof lastFocus.focus === 'function') lastFocus.focus();
			}

			function showPrev() {
				lightboxIndex = (lightboxIndex - 1 + galleryItems.length) % galleryItems.length;
				updateLightbox();
			}

			function showNext() {
				lightboxIndex = (lightboxIndex + 1) % galleryItems.length;
				updateLightbox();
			}

			galleryTriggers.forEach(function (btn) {
				btn.addEventListener('click', function () {
					var idx = parseInt(btn.getAttribute('data-gallery-index'), 10);
					openLightbox(isNaN(idx) ? 0 : idx);
				});
			});

			lightbox.addEventListener('click', function (e) {
				if (e.target.closest('[data-gallery-close]')) closeLightbox();
				if (e.target.closest('[data-gallery-prev]')) showPrev();
				if (e.target.closest('[data-gallery-next]')) showNext();
			});

			document.addEventListener('keydown', function (e) {
				if (lightbox.hidden) return;
				if (e.key === 'Escape') {
					e.preventDefault();
					closeLightbox();
				} else if (e.key === 'ArrowLeft') {
					e.preventDefault();
					showPrev();
				} else if (e.key === 'ArrowRight') {
					e.preventDefault();
					showNext();
				}
			});

			lightbox.addEventListener('touchstart', function (e) {
				if (!e.touches.length) return;
				touchStartX = e.touches[0].clientX;
			}, { passive: true });

			lightbox.addEventListener('touchend', function (e) {
				if (!e.changedTouches.length) return;
				var dx = e.changedTouches[0].clientX - touchStartX;
				if (Math.abs(dx) < 50) return;
				if (dx > 0) showPrev();
				else showNext();
			}, { passive: true });
		}
	}

	/* Google Reviews — continuous auto-scroll carousel */
	var reviewsSection = document.querySelector('[data-google-reviews]');
	if (reviewsSection) {
		var reviewsTrack = reviewsSection.querySelector('[data-reviews-track]');
		var reviewsPrev = reviewsSection.querySelector('[data-reviews-prev]');
		var reviewsNext = reviewsSection.querySelector('[data-reviews-next]');
		var reviewsReduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var reviewsPaused = false;
		var reviewsInView = false;
		var reviewsRaf = 0;
		var reviewsResumeTimer = null;
		var reviewsLoopWidth = 0;
		var reviewsSpeed = 0.45; /* px per frame ~27px/s at 60fps */

		function getReviewCards() {
			return reviewsTrack ? Array.prototype.slice.call(reviewsTrack.querySelectorAll('.g-review-card')) : [];
		}

		function getReviewStep() {
			var card = reviewsTrack && reviewsTrack.querySelector('.g-review-card');
			if (!card) return 320;
			var styles = window.getComputedStyle(reviewsTrack);
			var gap = parseFloat(styles.columnGap || styles.gap) || 16;
			return card.offsetWidth + gap;
		}

		function measureReviewsLoop() {
			if (!reviewsTrack) return 0;
			var cards = getReviewCards().filter(function (card) {
				return !card.hasAttribute('data-review-clone');
			});
			if (!cards.length) return 0;
			var styles = window.getComputedStyle(reviewsTrack);
			var gap = parseFloat(styles.columnGap || styles.gap) || 16;
			var width = 0;
			cards.forEach(function (card, index) {
				width += card.offsetWidth;
				if (index < cards.length - 1) width += gap;
			});
			/* include trailing gap before clones */
			width += gap;
			reviewsLoopWidth = width;
			return width;
		}

		function ensureReviewClones() {
			if (!reviewsTrack || reviewsReduceMotion) return;
			var originals = getReviewCards().filter(function (card) {
				return !card.hasAttribute('data-review-clone');
			});
			if (originals.length < 2) return;

			getReviewCards().forEach(function (card) {
				if (card.hasAttribute('data-review-clone')) {
					card.parentNode.removeChild(card);
				}
			});

			originals.forEach(function (card) {
				var clone = card.cloneNode(true);
				clone.setAttribute('data-review-clone', '1');
				clone.setAttribute('aria-hidden', 'true');
				reviewsTrack.appendChild(clone);
			});

			measureReviewsLoop();
		}

		function updateReviewNav() {
			if (!reviewsTrack || !reviewsPrev || !reviewsNext) return;
			var maxScroll = reviewsTrack.scrollWidth - reviewsTrack.clientWidth;
			var canScroll = maxScroll > 8;
			reviewsPrev.disabled = !canScroll;
			reviewsNext.disabled = !canScroll;
		}

		function scrollReviews(direction) {
			if (!reviewsTrack) return;
			reviewsTrack.classList.add('is-snapping');
			reviewsTrack.scrollBy({ left: direction * getReviewStep(), behavior: 'smooth' });
			window.setTimeout(function () {
				reviewsTrack.classList.remove('is-snapping');
			}, 500);
		}

		function stopReviewsAuto() {
			if (reviewsRaf) {
				window.cancelAnimationFrame(reviewsRaf);
				reviewsRaf = 0;
			}
			if (reviewsTrack) {
				reviewsTrack.classList.remove('is-auto-scrolling');
			}
		}

		function tickReviewsAuto() {
			reviewsRaf = 0;
			if (!reviewsTrack || reviewsPaused || !reviewsInView || reviewsReduceMotion) {
				return;
			}

			if (!reviewsLoopWidth) {
				measureReviewsLoop();
			}

			var maxScroll = reviewsTrack.scrollWidth - reviewsTrack.clientWidth;
			if (maxScroll <= 8) {
				return;
			}

			reviewsTrack.classList.add('is-auto-scrolling');
			reviewsTrack.scrollLeft += reviewsSpeed;

			if (reviewsLoopWidth > 0 && reviewsTrack.scrollLeft >= reviewsLoopWidth) {
				reviewsTrack.scrollLeft -= reviewsLoopWidth;
			} else if (reviewsTrack.scrollLeft >= maxScroll - 1) {
				reviewsTrack.scrollLeft = 0;
			}

			reviewsRaf = window.requestAnimationFrame(tickReviewsAuto);
		}

		function startReviewsAuto() {
			if (reviewsReduceMotion || reviewsPaused || !reviewsInView || !reviewsTrack) return;
			if (reviewsRaf) return;
			ensureReviewClones();
			measureReviewsLoop();
			updateReviewNav();
			var maxScroll = reviewsTrack.scrollWidth - reviewsTrack.clientWidth;
			if (maxScroll <= 8) return;
			reviewsRaf = window.requestAnimationFrame(tickReviewsAuto);
		}

		function pauseReviewsAuto(temporary) {
			reviewsPaused = true;
			stopReviewsAuto();
			if (reviewsResumeTimer) {
				window.clearTimeout(reviewsResumeTimer);
				reviewsResumeTimer = null;
			}
			if (temporary) {
				reviewsResumeTimer = window.setTimeout(function () {
					reviewsPaused = false;
					startReviewsAuto();
				}, 5000);
			}
		}

		function resumeReviewsAuto() {
			if (reviewsResumeTimer) {
				window.clearTimeout(reviewsResumeTimer);
				reviewsResumeTimer = null;
			}
			reviewsPaused = false;
			startReviewsAuto();
		}

		if (reviewsTrack) {
			ensureReviewClones();
			updateReviewNav();

			reviewsTrack.addEventListener('scroll', updateReviewNav, { passive: true });
			window.addEventListener('resize', function () {
				ensureReviewClones();
				measureReviewsLoop();
				updateReviewNav();
				if (reviewsInView && !reviewsPaused) {
					stopReviewsAuto();
					startReviewsAuto();
				}
			});

			reviewsSection.addEventListener('mouseenter', function () {
				pauseReviewsAuto(false);
			});
			reviewsSection.addEventListener('mouseleave', resumeReviewsAuto);
			reviewsTrack.addEventListener('focusin', function () {
				pauseReviewsAuto(false);
			});
			reviewsTrack.addEventListener('focusout', function () {
				window.setTimeout(function () {
					if (!reviewsSection.contains(document.activeElement)) {
						resumeReviewsAuto();
					}
				}, 0);
			});
			reviewsTrack.addEventListener('touchstart', function () {
				pauseReviewsAuto(true);
			}, { passive: true });
			reviewsTrack.addEventListener('wheel', function () {
				pauseReviewsAuto(true);
			}, { passive: true });

			if ('IntersectionObserver' in window) {
				var reviewsVisibility = new IntersectionObserver(function (entries) {
					entries.forEach(function (entry) {
						reviewsInView = entry.isIntersecting && entry.intersectionRatio > 0.05;
						if (reviewsInView) {
							startReviewsAuto();
						} else {
							stopReviewsAuto();
						}
					});
				}, { threshold: [0, 0.05, 0.15, 0.35] });
				reviewsVisibility.observe(reviewsSection);
			} else {
				reviewsInView = true;
				startReviewsAuto();
			}

			/* Fallback: start shortly after load if already near viewport */
			window.setTimeout(function () {
				if (!reviewsRaf && reviewsTrack.getBoundingClientRect().top < window.innerHeight) {
					reviewsInView = true;
					startReviewsAuto();
				}
			}, 800);
		}

		if (reviewsPrev) {
			reviewsPrev.addEventListener('click', function () {
				pauseReviewsAuto(true);
				scrollReviews(-1);
			});
		}

		if (reviewsNext) {
			reviewsNext.addEventListener('click', function () {
				pauseReviewsAuto(true);
				scrollReviews(1);
			});
		}
	}

	/* AJAX contact form */
	var contactForm = document.getElementById('hausmeister-contact-form');
	if (contactForm && typeof hausmeisterAjax !== 'undefined') {
		contactForm.addEventListener('submit', function (e) {
			e.preventDefault();

			var messageEl = contactForm.querySelector('.form-message');
			var submitBtn = contactForm.querySelector('[type="submit"]');
			var formData = new FormData(contactForm);

			formData.append('action', 'hausmeister_contact');
			formData.append('nonce', hausmeisterAjax.nonce);

			if (submitBtn) submitBtn.disabled = true;

			fetch(hausmeisterAjax.ajaxUrl, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin'
			})
				.then(function (res) { return res.json(); })
				.then(function (data) {
					if (!messageEl) return;
					messageEl.classList.remove('is-success', 'is-error');
					if (data.success) {
						messageEl.classList.add('is-success');
						messageEl.textContent = data.data.message;
						contactForm.reset();
					} else {
						messageEl.classList.add('is-error');
						messageEl.textContent = data.data && data.data.message
							? data.data.message
							: 'Ein Fehler ist aufgetreten.';
					}
				})
				.catch(function () {
					if (messageEl) {
						messageEl.classList.remove('is-success');
						messageEl.classList.add('is-error');
						messageEl.textContent = 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.';
					}
				})
				.finally(function () {
					if (submitBtn) submitBtn.disabled = false;
				});
		});
	}
})();
