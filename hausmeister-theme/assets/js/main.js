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
