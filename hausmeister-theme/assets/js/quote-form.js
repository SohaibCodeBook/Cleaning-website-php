/**
 * Multi-step quote form wizard.
 */
(function () {
	'use strict';

	function initQuoteForm(root) {
		var form = root.querySelector('[data-quote-form-el]');
		if (!form) return;

		var panels = root.querySelectorAll('[data-quote-panel]');
		var indicators = root.querySelectorAll('[data-quote-step-indicator]');
		var propertyHidden = form.querySelector('[data-quote-property-type]');
		var reviewEl = form.querySelector('[data-quote-review]');
		var messageEl = form.querySelector('[data-quote-message]');
		var current = 1;
		var total = panels.length;

		function getPanel(step) {
			return form.querySelector('[data-quote-panel="' + step + '"]');
		}

		function showError(step, text) {
			var panel = getPanel(step);
			if (!panel) return;
			var err = panel.querySelector('[data-quote-error]');
			if (!err) return;
			if (text) {
				err.hidden = false;
				err.textContent = text;
			} else {
				err.hidden = true;
				err.textContent = '';
			}
		}

		function clearErrors() {
			for (var i = 1; i <= total; i++) {
				showError(i, '');
			}
			if (messageEl) {
				messageEl.hidden = true;
				messageEl.classList.remove('is-success', 'is-error');
				messageEl.textContent = '';
			}
		}

		function syncPropertyType() {
			var selected = form.querySelector('[data-quote-property-choice]:checked');
			if (propertyHidden) {
				propertyHidden.value = selected ? selected.value : '';
			}
			return selected;
		}

		function getSelectedServices() {
			return Array.prototype.map.call(
				form.querySelectorAll('[data-quote-service]:checked'),
				function (el) { return el.value; }
			);
		}

		function validateStep(step) {
			clearErrors();

			if (step === 1) {
				if (!getSelectedServices().length) {
					showError(1, 'Bitte wählen Sie mindestens eine Leistung aus.');
					return false;
				}
				return true;
			}

			if (step === 2) {
				if (!syncPropertyType()) {
					showError(2, 'Bitte wählen Sie einen Objekttyp aus.');
					return false;
				}
				return true;
			}

			if (step === 3) {
				var name = form.querySelector('[name="name"]');
				var email = form.querySelector('[name="email"]');
				var message = form.querySelector('[name="message"]');
				if (!name || !name.value.trim()) {
					showError(3, 'Bitte geben Sie Ihren Namen ein.');
					if (name) name.focus();
					return false;
				}
				if (!email || !email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
					showError(3, 'Bitte geben Sie eine gültige E-Mail-Adresse ein.');
					if (email) email.focus();
					return false;
				}
				if (!message || !message.value.trim()) {
					showError(3, 'Bitte geben Sie eine Nachricht ein.');
					if (message) message.focus();
					return false;
				}
				return true;
			}

			return true;
		}

		function buildReview() {
			if (!reviewEl) return;

			var services = getSelectedServices();
			var property = syncPropertyType();
			var propertyLabel = property ? property.getAttribute('data-quote-property-label') : '';
			var size = (form.querySelector('[name="property_size"]') || {}).value || '';
			var city = (form.querySelector('[name="property_city"]') || {}).value || '';
			var name = (form.querySelector('[name="name"]') || {}).value || '';
			var email = (form.querySelector('[name="email"]') || {}).value || '';
			var phone = (form.querySelector('[name="phone"]') || {}).value || '';
			var subject = (form.querySelector('[name="subject"]') || {}).value || '';
			var message = (form.querySelector('[name="message"]') || {}).value || '';

			var propertyLines = propertyLabel;
			if (size.trim()) propertyLines += '\nGröße: ' + size.trim() + ' m²';
			if (city.trim()) propertyLines += '\nOrt: ' + city.trim();

			var contactLines = name + '\n' + email;
			if (phone.trim()) contactLines += '\n' + phone.trim();
			if (subject.trim()) contactLines += '\nBetreff: ' + subject.trim();

			var html = '';
			html += '<div class="quote-form__review-block">';
			html += '<span class="quote-form__review-label">Leistungen</span>';
			html += '<div class="quote-form__review-tags">';
			services.forEach(function (s) {
				html += '<span class="quote-form__review-tag">' + escapeHtml(s) + '</span>';
			});
			html += '</div></div>';

			html += '<div class="quote-form__review-block">';
			html += '<span class="quote-form__review-label">Objekt</span>';
			html += '<p class="quote-form__review-value">' + escapeHtml(propertyLines) + '</p>';
			html += '</div>';

			html += '<div class="quote-form__review-block">';
			html += '<span class="quote-form__review-label">Kontaktdaten</span>';
			html += '<p class="quote-form__review-value">' + escapeHtml(contactLines) + '</p>';
			html += '</div>';

			html += '<div class="quote-form__review-block">';
			html += '<span class="quote-form__review-label">Nachricht</span>';
			html += '<p class="quote-form__review-value">' + escapeHtml(message) + '</p>';
			html += '</div>';

			reviewEl.innerHTML = html;
		}

		function escapeHtml(str) {
			return String(str)
				.replace(/&/g, '&amp;')
				.replace(/</g, '&lt;')
				.replace(/>/g, '&gt;')
				.replace(/"/g, '&quot;')
				.replace(/'/g, '&#39;')
				.replace(/\n/g, '<br>');
		}

		function goTo(step) {
			current = step;
			panels.forEach(function (panel) {
				var num = parseInt(panel.getAttribute('data-quote-panel'), 10);
				var active = num === current;
				panel.hidden = !active;
				panel.classList.toggle('is-active', active);
			});

			indicators.forEach(function (item) {
				var num = parseInt(item.getAttribute('data-quote-step-indicator'), 10);
				item.classList.toggle('is-active', num === current);
				item.classList.toggle('is-complete', num < current);
			});

			if (current === 4) {
				buildReview();
			}

			root.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
		}

		form.querySelectorAll('[data-quote-next]').forEach(function (btn) {
			btn.addEventListener('click', function () {
				if (!validateStep(current)) return;
				if (current < total) goTo(current + 1);
			});
		});

		form.querySelectorAll('[data-quote-back]').forEach(function (btn) {
			btn.addEventListener('click', function () {
				clearErrors();
				if (current > 1) goTo(current - 1);
			});
		});

		form.querySelectorAll('[data-quote-property-choice]').forEach(function (input) {
			input.addEventListener('change', syncPropertyType);
		});

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			if (!validateStep(1)) {
				goTo(1);
				return;
			}
			if (!validateStep(2)) {
				goTo(2);
				return;
			}
			if (!validateStep(3)) {
				goTo(3);
				return;
			}

			if (typeof hausmeisterAjax === 'undefined') {
				showError(4, 'Formular ist nicht korrekt konfiguriert.');
				return;
			}

			var submitBtn = form.querySelector('[data-quote-submit]');
			var formData = new FormData(form);
			formData.append('action', 'hausmeister_quote');
			formData.append('nonce', hausmeisterAjax.nonce);

			/* Ensure services are present even if browser quirks */
			formData.delete('services[]');
			getSelectedServices().forEach(function (service) {
				formData.append('services[]', service);
			});
			syncPropertyType();
			if (propertyHidden) {
				formData.set('property_type', propertyHidden.value);
			}

			if (submitBtn) submitBtn.disabled = true;
			clearErrors();

			fetch(hausmeisterAjax.ajaxUrl, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin'
			})
				.then(function (res) { return res.json(); })
				.then(function (data) {
					if (!messageEl) return;
					messageEl.hidden = false;
					messageEl.classList.remove('is-success', 'is-error');
					if (data.success) {
						messageEl.classList.add('is-success');
						messageEl.textContent = data.data.message;
						form.reset();
						if (propertyHidden) propertyHidden.value = '';
						window.setTimeout(function () {
							goTo(1);
						}, 2500);
					} else {
						messageEl.classList.add('is-error');
						messageEl.textContent = data.data && data.data.message
							? data.data.message
							: 'Ein Fehler ist aufgetreten.';
					}
				})
				.catch(function () {
					if (messageEl) {
						messageEl.hidden = false;
						messageEl.classList.remove('is-success');
						messageEl.classList.add('is-error');
						messageEl.textContent = 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.';
					}
				})
				.finally(function () {
					if (submitBtn) submitBtn.disabled = false;
				});
		});

		goTo(1);
	}

	document.querySelectorAll('[data-quote-form]').forEach(initQuoteForm);
})();
