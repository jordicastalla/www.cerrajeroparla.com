<?php
/**
 * Homepage: industrial hero, the three core services, how it works and service area.
 *
 * With a static front page: its excerpt is the hero lead, its two photo slots and
 * its four text slots (intro, urgencias, económicos, CTA) fill the sections below.
 * Empty text slots are hidden from visitors; editors see a hint in their place.
 *
 * @package Cerrajeros_Parla
 */

get_header();

$cpc_static = 'page' === get_option( 'show_on_front' ) && have_posts();
if ( $cpc_static ) {
	the_post();
}

// Home text slots (inc/text-slots.php): intro, urgencias, economicos, cta.
$cpc_texts   = $cpc_static ? cpc_get_texts() : array( 'blocks' => array(), 'cta' => '' );
$cpc_can     = $cpc_static && current_user_can( 'edit_post', get_the_ID() );
$cpc_intro   = isset( $cpc_texts['blocks']['intro'] ) ? $cpc_texts['blocks']['intro'] : '';
$cpc_urgent  = isset( $cpc_texts['blocks']['urgencias'] ) ? $cpc_texts['blocks']['urgencias'] : '';
$cpc_cheap   = isset( $cpc_texts['blocks']['economicos'] ) ? $cpc_texts['blocks']['economicos'] : '';
$cpc_content = ( $cpc_static && '' === $cpc_intro && '' !== trim( get_the_content() ) ) ? apply_filters( 'the_content', get_the_content() ) : '';
$cpc_copy_1  = '' !== $cpc_intro ? $cpc_intro : $cpc_content; // Without an intro, the main editor content takes its place.

$cpc_lead = ( $cpc_static && has_excerpt() )
	? wpautop( wp_kses_post( get_the_excerpt() ) )
	: '<p>' . esc_html__( 'Apertura de puertas y urgencias de cerrajería en Parla y Madrid Sur. Llama a cualquier hora del día o de la noche.', 'cerrajeros-parla' ) . '</p>';
?>
<main id="content" class="site-main">

	<section class="hero-industrial hero-home bg-forge-black text-white">
		<span class="hero-watermark" aria-hidden="true">24H</span>
		<div class="hero-inner">
			<div class="hero-copy">
				<p class="hero-eyebrow"><?php esc_html_e( 'Cerrajeros urgentes · Parla (Madrid)', 'cerrajeros-parla' ); ?></p>
				<h1 class="font-outfit text-gold"><?php echo esc_html( apply_filters( 'cpc_front_h1', __( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ) ) ); ?></h1>
				<div class="lead-text"><?php echo wp_kses_post( $cpc_lead ); ?></div>
				<div class="hero-actions">
					<?php cpc_call_button( 'hero', '', 'btn-xl' ); ?>
					<a class="btn-steel" href="#servicios"><?php esc_html_e( 'Ver servicios', 'cerrajeros-parla' ); ?></a>
				</div>
			</div>

			<ul class="hero-plates" aria-label="<?php esc_attr_e( 'Datos del servicio', 'cerrajeros-parla' ); ?>">
				<li class="hero-plate card-steel">
					<strong>24 h</strong>
					<span><?php esc_html_e( 'Todos los días del año', 'cerrajeros-parla' ); ?></span>
				</li>
				<li class="hero-plate card-steel">
					<strong>Parla</strong>
					<span><?php esc_html_e( 'y zona de Madrid Sur', 'cerrajeros-parla' ); ?></span>
				</li>
				<li class="hero-plate card-steel">
					<strong><?php esc_html_e( 'Directo', 'cerrajeros-parla' ); ?></strong>
					<span><?php esc_html_e( 'Solo por teléfono, sin formularios', 'cerrajeros-parla' ); ?></span>
				</li>
			</ul>
		</div>
	</section>

	<?php /* INTRO: full width */ ?>
	<?php if ( '' !== $cpc_copy_1 || $cpc_can ) : ?>
		<section class="section-block text-slots home-intro">
			<div class="wrap narrow text-slot entry-content">
				<?php cpc_slot_or_hint( $cpc_copy_1, __( 'Introducción', 'cerrajeros-parla' ) ); ?>
			</div>
		</section>
	<?php endif; ?>

	<?php /* SECTION | PHOTO 1 (only with a static front page, which holds the photos) */ ?>
	<?php if ( $cpc_static ) : ?>
	<section class="grid-layout-2col section-block home-urgent" aria-label="<?php esc_attr_e( 'Urgencias 24 horas', 'cerrajeros-parla' ); ?>">
		<div class="copy-block-1 entry-content">
			<?php cpc_slot_or_hint( $cpc_urgent, __( '24 horas – Urgencias', 'cerrajeros-parla' ) ); ?>
		</div>
		<figure class="photo-slot photo-slot-1 card-steel">
			<?php cpc_photo_slot( 1, __( 'Cerrajeros en Parla', 'cerrajeros-parla' ) ); ?>
		</figure>
	</section>
	<?php endif; ?>

	<section id="servicios" class="section-block services-section" aria-labelledby="servicios-title">
		<div class="wrap">
			<header class="section-head">
				<p class="section-kicker"><?php esc_html_e( 'Servicios de cerrajería en Parla', 'cerrajeros-parla' ); ?></p>
				<h2 id="servicios-title"><?php esc_html_e( 'Tres especialidades, un solo número', 'cerrajeros-parla' ); ?></h2>
			</header>
			<?php get_template_part( 'template-parts/services-grid' ); ?>
		</div>
	</section>

	<div class="divider-angled" aria-hidden="true"></div>

	<?php /* PHOTO 2 | SECTION */ ?>
	<?php if ( $cpc_static ) : ?>
	<section class="grid-layout-2col reverse-mobile section-block bg-steel home-cheap" aria-label="<?php esc_attr_e( 'Precios', 'cerrajeros-parla' ); ?>">
		<figure class="photo-slot photo-slot-2 card-steel">
			<?php cpc_photo_slot( 2, __( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ) ); ?>
		</figure>
		<div class="copy-block-2 entry-content">
			<?php cpc_slot_or_hint( $cpc_cheap, __( 'Cerrajeros económicos', 'cerrajeros-parla' ) ); ?>
		</div>
	</section>
	<?php endif; ?>

	<?php /* CTA */ ?>
	<?php if ( '' !== $cpc_texts['cta'] || $cpc_can ) : ?>
		<div class="divider-angled divider-angled--down" aria-hidden="true"></div>
		<section class="section-block text-slots home-cta">
			<div class="wrap narrow">
				<?php
				if ( '' !== $cpc_texts['cta'] ) {
					cpc_cta_slot( $cpc_texts['cta'] );
				} else {
					cpc_empty_slot_hint( __( 'CTA (llamada a la acción)', 'cerrajeros-parla' ) );
				}
				?>
			</div>
		</section>
		<div class="divider-angled" aria-hidden="true"></div>
	<?php endif; ?>

	<section class="section-block bg-steel steps-section" aria-labelledby="como-title">
		<div class="wrap steps-layout">
			<div>
				<header class="section-head">
					<p class="section-kicker"><?php esc_html_e( 'Cómo funciona', 'cerrajeros-parla' ); ?></p>
					<h2 id="como-title"><?php esc_html_e( 'Del aviso a la puerta, en tres pasos', 'cerrajeros-parla' ); ?></h2>
				</header>
				<ol class="steps">
					<li class="step">
						<span class="step__num" aria-hidden="true">1</span>
						<div>
							<h3>
								<?php
								/* translators: %s: phone number. */
								echo esc_html( sprintf( __( 'Llama al %s', 'cerrajeros-parla' ), CPC_PHONE_DISPLAY ) );
								?>
							</h3>
							<p><?php esc_html_e( 'Atendemos por teléfono las 24 horas, de lunes a domingo.', 'cerrajeros-parla' ); ?></p>
						</div>
					</li>
					<li class="step">
						<span class="step__num" aria-hidden="true">2</span>
						<div>
							<h3><?php esc_html_e( 'Cuéntanos qué ocurre', 'cerrajeros-parla' ); ?></h3>
							<p><?php esc_html_e( 'Puerta cerrada, llave perdida o cualquier avería: explícanos qué ha pasado.', 'cerrajeros-parla' ); ?></p>
						</div>
					</li>
					<li class="step">
						<span class="step__num" aria-hidden="true">3</span>
						<div>
							<h3><?php esc_html_e( 'Vamos a tu dirección', 'cerrajeros-parla' ); ?></h3>
							<p><?php esc_html_e( 'Un cerrajero se desplaza a tu vivienda, portal o local en Parla.', 'cerrajeros-parla' ); ?></p>
						</div>
					</li>
				</ol>
			</div>

			<aside class="area-card card-steel" aria-labelledby="zona-title">
				<span class="area-card__icon"><?php echo cpc_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
				<h2 id="zona-title" class="area-card__title"><?php esc_html_e( 'Zona de servicio', 'cerrajeros-parla' ); ?></h2>
				<p><?php esc_html_e( 'Trabajamos en Parla (Madrid) y en la zona de Madrid Sur.', 'cerrajeros-parla' ); ?></p>
				<a class="btn-dark" href="<?php echo esc_url( CPC_MAPS_URL ); ?>" target="_blank" rel="noopener">
					<?php echo cpc_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<span><?php esc_html_e( 'Ver en Google Maps', 'cerrajeros-parla' ); ?></span>
					<span class="screen-reader-text"><?php esc_html_e( '(se abre en una pestaña nueva)', 'cerrajeros-parla' ); ?></span>
				</a>
			</aside>
		</div>
	</section>

</main>
<?php
get_footer();
