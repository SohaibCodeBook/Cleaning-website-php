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
		if (e.key === 'Escape') closeNav();
	});

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
		var baTabs = baGallery.querySelectorAll('[data-ba-tab]');
		var baCards = baGallery.querySelectorAll('[data-ba-card]');
		var baEmpty = baGallery.querySelector('[data-ba-empty]');
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

		function applyFilter(category) {
			var visible = 0;
			baCards.forEach(function (card) {
				var show = category === 'all' || card.getAttribute('data-ba-category') === category;
				card.classList.toggle('is-hidden', !show);
				if (show) {
					visible++;
					card.classList.remove('is-filtering-in');
					void card.offsetWidth;
					card.classList.add('is-filtering-in');
					var slider = card.querySelector('[data-ba-slider]');
					if (slider && slider._baSync) slider._baSync();
					if (slider && slider._baSetPos) slider._baSetPos(50);
				}
			});
			if (baEmpty) baEmpty.hidden = visible > 0;
		}

		baTabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				var category = tab.getAttribute('data-ba-tab');
				baTabs.forEach(function (t) {
					var active = t === tab;
					t.classList.toggle('is-active', active);
					t.setAttribute('aria-selected', active ? 'true' : 'false');
				});
				applyFilter(category);
			});
		});
	}

	/* Google Reviews carousel */
	var reviewsSection = document.querySelector('[data-google-reviews]');
	if (reviewsSection) {
		var reviewsTrack = reviewsSection.querySelector('[data-reviews-track]');
		var reviewsPrev = reviewsSection.querySelector('[data-reviews-prev]');
		var reviewsNext = reviewsSection.querySelector('[data-reviews-next]');

		function updateReviewNav() {
			if (!reviewsTrack || !reviewsPrev || !reviewsNext) return;
			var maxScroll = reviewsTrack.scrollWidth - reviewsTrack.clientWidth;
			reviewsPrev.disabled = reviewsTrack.scrollLeft <= 4;
			reviewsNext.disabled = reviewsTrack.scrollLeft >= maxScroll - 4;
		}

		function scrollReviews(direction) {
			if (!reviewsTrack) return;
			var card = reviewsTrack.querySelector('.g-review-card');
			var amount = card ? card.offsetWidth + 16 : 320;
			reviewsTrack.scrollBy({ left: direction * amount, behavior: 'smooth' });
		}

		if (reviewsTrack) {
			reviewsTrack.addEventListener('scroll', updateReviewNav, { passive: true });
			window.addEventListener('resize', updateReviewNav);
			updateReviewNav();
		}

		if (reviewsPrev) {
			reviewsPrev.addEventListener('click', function () {
				scrollReviews(-1);
			});
		}

		if (reviewsNext) {
			reviewsNext.addEventListener('click', function () {
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
