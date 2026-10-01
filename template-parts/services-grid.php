<?php
/**
 * The three core services as forged steel cards.
 *
 * @package Cerrajeros_Parla
 *
 * @var array $args {
 *     @type string $heading_level Heading tag for each card title. Default 'h3'.
 * }
 */

$cpc_tag = ( isset( $args['heading_level'] ) && in_array( $args['heading_level'], array( 'h2', 'h3' ), true ) ) ? $args['heading_level'] : 'h3';
?>
<ul class="services-grid">
	<?php foreach ( cpc_services() as $cpc_i => $cpc_service ) : ?>
		<li class="service-card card-steel">
			<span class="service-card__num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $cpc_i + 1 ) ); ?></span>
			<span class="service-card__icon"><?php echo cpc_icon( $cpc_service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></span>
			<<?php echo esc_html( $cpc_tag ); ?> class="service-card__title">
				<a href="<?php echo esc_url( $cpc_service['url'] ); ?>"><?php echo esc_html( $cpc_service['name'] ); ?></a>
			</<?php echo esc_html( $cpc_tag ); ?>>
			<p><?php echo esc_html( $cpc_service['text'] ); ?></p>
			<span class="service-card__more" aria-hidden="true">
				<?php esc_html_e( 'Ver servicio', 'cerrajeros-parla' ); ?>
				<?php echo cpc_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
			</span>
		</li>
	<?php endforeach; ?>
</ul>
