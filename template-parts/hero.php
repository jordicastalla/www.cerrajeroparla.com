<?php
/**
 * Industrial hero with diagonal bottom cut.
 *
 * @package Cerrajeros_Parla
 *
 * @var array $args {
 *     @type string $title   H1 text (may contain inline HTML).
 *     @type string $lead    Lead paragraph HTML.
 *     @type string $eyebrow Small label above the H1.
 *     @type bool   $cta     Whether to print the call button.
 * }
 */

$args = wp_parse_args(
	$args,
	array(
		'title'   => '',
		'lead'    => '',
		'eyebrow' => __( 'Cerrajeros 24 h · Parla (Madrid)', 'cerrajeros-parla' ),
		'cta'     => true,
	)
);
?>
<section class="hero-industrial bg-forge-black text-white">
	<span class="hero-watermark" aria-hidden="true">24H</span>
	<div class="hero-inner">
		<?php if ( $args['eyebrow'] ) : ?>
			<p class="hero-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
		<?php endif; ?>

		<h1 class="font-outfit text-gold"><?php echo wp_kses_post( $args['title'] ); ?></h1>

		<?php if ( $args['lead'] ) : ?>
			<div class="lead-text"><?php echo wp_kses_post( $args['lead'] ); ?></div>
		<?php endif; ?>

		<?php if ( $args['cta'] ) : ?>
			<div class="hero-actions">
				<?php cpc_call_button( 'hero', '', 'btn-xl' ); ?>
				<p class="hero-note">
					<?php echo cpc_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<?php esc_html_e( 'Atención telefónica 24 horas, todos los días', 'cerrajeros-parla' ); ?>
				</p>
			</div>
		<?php endif; ?>
	</div>
</section>
