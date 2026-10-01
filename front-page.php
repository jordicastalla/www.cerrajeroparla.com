<?php
/**
 * Homepage: industrial hero, the three core services, how it works and service area.
 *
 * If a static front page is set, its excerpt replaces the hero lead and its
 * content is printed below the services.
 *
 * @package Cerrajeros_Parla
 */

get_header();

$cpc_static = 'page' === get_option( 'show_on_front' ) && have_posts();
if ( $cpc_static ) {
	the_post();
}

$cpc_lead = ( $cpc_static && has_excerpt() )
	? wpautop( wp_kses_post( get_the_excerpt() ) )
	: '<p>' . esc_html__( 'Cambio de cerraduras, instalación de cerrojos y reparación de cierres metálicos en Parla y Madrid Sur. Llama a cualquier hora del día o de la noche.', 'cerrajeros-parla' ) . '</p>';
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

	<section id="servicios" class="section-block services-section" aria-labelledby="servicios-title">
		<div class="wrap">
			<header class="section-head">
				<p class="section-kicker"><?php esc_html_e( 'Servicios de cerrajería en Parla', 'cerrajeros-parla' ); ?></p>
				<h2 id="servicios-title"><?php esc_html_e( 'Tres especialidades, un solo número', 'cerrajeros-parla' ); ?></h2>
			</header>
			<?php get_template_part( 'template-parts/services-grid' ); ?>
		</div>
	</section>

	<?php if ( $cpc_static && '' !== trim( get_the_content() ) ) : ?>
		<section class="section-block home-content">
			<div class="wrap entry-content narrow">
				<?php the_content(); ?>
			</div>
		</section>
	<?php endif; ?>

	<div class="divider-angled" aria-hidden="true"></div>

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
							<p><?php esc_html_e( 'Puerta cerrada, cerradura dañada, cerrojo nuevo o cierre metálico que no sube ni baja.', 'cerrajeros-parla' ); ?></p>
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
