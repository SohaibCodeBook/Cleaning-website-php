<?php
/**
 * Multi-step quote form markup.
 *
 * Expects $args['form_id'] and $args['title'].
 *
 * @package Hausmeister_Theme
 */

defined( 'ABSPATH' ) || exit;

$form_id        = isset( $args['form_id'] ) ? $args['form_id'] : 'hausmeister-quote-form';
$title          = isset( $args['title'] ) ? $args['title'] : __( 'Nachricht senden', 'hausmeister-theme' );
$services       = hausmeister_get_services();
$property_types = hausmeister_get_quote_property_types();
$steps          = hausmeister_get_quote_form_steps();
$uid            = esc_attr( $form_id );
?>

<div class="quote-form" data-quote-form id="<?php echo $uid; ?>">
	<div class="quote-form__card">
		<h2 class="quote-form__heading"><?php echo esc_html( $title ); ?></h2>

		<ol class="quote-form__steps" data-quote-steps aria-label="<?php esc_attr_e( 'Formularfortschritt', 'hausmeister-theme' ); ?>">
			<?php foreach ( $steps as $num => $label ) : ?>
				<li
					class="quote-form__step<?php echo 1 === (int) $num ? ' is-active' : ''; ?>"
					data-quote-step-indicator="<?php echo esc_attr( (string) $num ); ?>"
				>
					<span class="quote-form__step-marker" aria-hidden="true">
						<span class="quote-form__step-num"><?php echo esc_html( (string) $num ); ?></span>
						<svg class="quote-form__step-check" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
					</span>
					<span class="quote-form__step-label"><?php echo esc_html( $label ); ?></span>
				</li>
			<?php endforeach; ?>
		</ol>

		<form class="quote-form__form" data-quote-form-el novalidate>
			<input type="hidden" name="property_type" value="" data-quote-property-type>

			<!-- Step 1: Services -->
			<section class="quote-form__panel is-active" data-quote-panel="1" aria-labelledby="<?php echo $uid; ?>-s1-title">
				<h3 class="quote-form__panel-title" id="<?php echo $uid; ?>-s1-title"><?php esc_html_e( 'Was benötigen Sie?', 'hausmeister-theme' ); ?></h3>
				<p class="quote-form__panel-text"><?php esc_html_e( 'Wählen Sie eine oder mehrere Leistungen aus.', 'hausmeister-theme' ); ?></p>

				<div class="quote-form__service-grid" role="group" aria-label="<?php esc_attr_e( 'Leistungen', 'hausmeister-theme' ); ?>">
					<?php foreach ( $services as $service ) : ?>
						<label class="quote-form__choice">
							<input
								type="checkbox"
								name="services[]"
								value="<?php echo esc_attr( $service['title'] ); ?>"
								class="quote-form__choice-input"
								data-quote-service
							>
							<span class="quote-form__choice-card">
								<span class="quote-form__choice-check" aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
								</span>
								<span class="quote-form__choice-icon" aria-hidden="true">
									<i class="<?php echo esc_attr( $service['icon'] ); ?>"></i>
								</span>
								<span class="quote-form__choice-label"><?php echo esc_html( $service['title'] ); ?></span>
							</span>
						</label>
					<?php endforeach; ?>
				</div>

				<p class="quote-form__error" data-quote-error hidden></p>

				<div class="quote-form__actions quote-form__actions--end">
					<button type="button" class="btn btn--primary quote-form__next" data-quote-next>
						<span><?php esc_html_e( 'Weiter', 'hausmeister-theme' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</button>
				</div>
			</section>

			<!-- Step 2: Property -->
			<section class="quote-form__panel" data-quote-panel="2" hidden aria-labelledby="<?php echo $uid; ?>-s2-title">
				<h3 class="quote-form__panel-title" id="<?php echo $uid; ?>-s2-title"><?php esc_html_e( 'Objektdetails', 'hausmeister-theme' ); ?></h3>
				<p class="quote-form__panel-text"><?php esc_html_e( 'Wählen Sie den Objekttyp und ergänzen Sie optional weitere Angaben.', 'hausmeister-theme' ); ?></p>

				<div class="quote-form__service-grid quote-form__service-grid--types" role="radiogroup" aria-label="<?php esc_attr_e( 'Objekttyp', 'hausmeister-theme' ); ?>">
					<?php foreach ( $property_types as $type ) : ?>
						<label class="quote-form__choice">
							<input
								type="radio"
								name="property_type_choice"
								value="<?php echo esc_attr( $type['id'] ); ?>"
								class="quote-form__choice-input"
								data-quote-property-choice
								data-quote-property-label="<?php echo esc_attr( $type['label'] ); ?>"
							>
							<span class="quote-form__choice-card">
								<span class="quote-form__choice-check" aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
								</span>
								<span class="quote-form__choice-icon" aria-hidden="true">
									<i class="<?php echo esc_attr( $type['icon'] ); ?>"></i>
								</span>
								<span class="quote-form__choice-label"><?php echo esc_html( $type['label'] ); ?></span>
							</span>
						</label>
					<?php endforeach; ?>
				</div>

				<div class="quote-form__fields quote-form__fields--split">
					<div class="quote-form__field">
						<label for="<?php echo $uid; ?>-size"><?php esc_html_e( 'Ungefähre Größe', 'hausmeister-theme' ); ?></label>
						<div class="quote-form__input-affix">
							<input type="text" id="<?php echo $uid; ?>-size" name="property_size" inputmode="numeric" placeholder="<?php esc_attr_e( 'z. B. 500', 'hausmeister-theme' ); ?>" autocomplete="off">
							<span class="quote-form__affix" aria-hidden="true">m²</span>
						</div>
					</div>
					<div class="quote-form__field">
						<label for="<?php echo $uid; ?>-city"><?php esc_html_e( 'Ort / Lage', 'hausmeister-theme' ); ?></label>
						<input type="text" id="<?php echo $uid; ?>-city" name="property_city" placeholder="<?php esc_attr_e( 'z. B. Bremen', 'hausmeister-theme' ); ?>" autocomplete="address-level2">
					</div>
				</div>

				<p class="quote-form__error" data-quote-error hidden></p>

				<div class="quote-form__actions">
					<button type="button" class="btn btn--secondary quote-form__back" data-quote-back>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
						<span><?php esc_html_e( 'Zurück', 'hausmeister-theme' ); ?></span>
					</button>
					<button type="button" class="btn btn--primary quote-form__next" data-quote-next>
						<span><?php esc_html_e( 'Weiter', 'hausmeister-theme' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</button>
				</div>
			</section>

			<!-- Step 3: Contact info -->
			<section class="quote-form__panel" data-quote-panel="3" hidden aria-labelledby="<?php echo $uid; ?>-s3-title">
				<h3 class="quote-form__panel-title" id="<?php echo $uid; ?>-s3-title"><?php esc_html_e( 'Ihre Daten', 'hausmeister-theme' ); ?></h3>
				<p class="quote-form__panel-text"><?php esc_html_e( 'Wie können wir Sie erreichen?', 'hausmeister-theme' ); ?></p>

				<div class="quote-form__fields">
					<div class="quote-form__fields quote-form__fields--split">
						<div class="quote-form__field">
							<label for="<?php echo $uid; ?>-name"><?php esc_html_e( 'Name', 'hausmeister-theme' ); ?> <span class="quote-form__req">*</span></label>
							<input type="text" id="<?php echo $uid; ?>-name" name="name" required autocomplete="name">
						</div>
						<div class="quote-form__field">
							<label for="<?php echo $uid; ?>-email"><?php esc_html_e( 'E-Mail', 'hausmeister-theme' ); ?> <span class="quote-form__req">*</span></label>
							<input type="email" id="<?php echo $uid; ?>-email" name="email" required autocomplete="email">
						</div>
					</div>
					<div class="quote-form__fields quote-form__fields--split">
						<div class="quote-form__field">
							<label for="<?php echo $uid; ?>-phone"><?php esc_html_e( 'Telefon', 'hausmeister-theme' ); ?></label>
							<input type="tel" id="<?php echo $uid; ?>-phone" name="phone" autocomplete="tel">
						</div>
						<div class="quote-form__field">
							<label for="<?php echo $uid; ?>-subject"><?php esc_html_e( 'Betreff', 'hausmeister-theme' ); ?></label>
							<input type="text" id="<?php echo $uid; ?>-subject" name="subject" autocomplete="off">
						</div>
					</div>
					<div class="quote-form__field">
						<label for="<?php echo $uid; ?>-message"><?php esc_html_e( 'Nachricht', 'hausmeister-theme' ); ?> <span class="quote-form__req">*</span></label>
						<textarea id="<?php echo $uid; ?>-message" name="message" rows="5" required></textarea>
					</div>
				</div>

				<p class="quote-form__error" data-quote-error hidden></p>

				<div class="quote-form__actions">
					<button type="button" class="btn btn--secondary quote-form__back" data-quote-back>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
						<span><?php esc_html_e( 'Zurück', 'hausmeister-theme' ); ?></span>
					</button>
					<button type="button" class="btn btn--primary quote-form__next" data-quote-next>
						<span><?php esc_html_e( 'Weiter', 'hausmeister-theme' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</button>
				</div>
			</section>

			<!-- Step 4: Review -->
			<section class="quote-form__panel" data-quote-panel="4" hidden aria-labelledby="<?php echo $uid; ?>-s4-title">
				<h3 class="quote-form__panel-title" id="<?php echo $uid; ?>-s4-title"><?php esc_html_e( 'Zusammenfassung', 'hausmeister-theme' ); ?></h3>
				<p class="quote-form__panel-text"><?php esc_html_e( 'Prüfen Sie Ihre Angaben und senden Sie die Anfrage ab.', 'hausmeister-theme' ); ?></p>

				<div class="quote-form__review" data-quote-review></div>

				<p class="quote-form__error" data-quote-error hidden></p>
				<div class="quote-form__message form-message" data-quote-message role="alert" hidden></div>

				<div class="quote-form__actions">
					<button type="button" class="btn btn--secondary quote-form__back" data-quote-back>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
						<span><?php esc_html_e( 'Zurück', 'hausmeister-theme' ); ?></span>
					</button>
					<button type="submit" class="btn btn--primary quote-form__submit" data-quote-submit>
						<span><?php echo esc_html( page_contact( 'form_submit_text', __( 'Anfrage senden', 'hausmeister-theme' ) ) ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
					</button>
				</div>
			</section>
		</form>
	</div>
</div>
