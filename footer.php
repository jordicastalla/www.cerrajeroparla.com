<?php
/**
 * Closing CTA band, footer (services, contact, Google Maps), legal row and mobile call bar.
 *
 * @package Cerrajeros_Parla
 */

?>
<section class="cta-band" aria-labelledby="cta-band-title">
	<div class="cta-band__inner">
		<div class="cta-band__copy">
			<p class="cta-band__eyebrow"><?php echo esc_html( cpc_copy( 'band_eyebrow' ) ); ?></p>
			<h2 id="cta-band-title"><?php echo esc_html( cpc_copy( 'band_title' ) ); ?></h2>
			<p><?php echo esc_html( cpc_copy( 'band_text' ) ); ?></p>
		</div>
		<?php cpc_call_button( 'cta-band', CPC_PHONE_DISPLAY, 'btn-xl' ); ?>
	</div>
</section>

<footer id="colophon" class="site-footer">
	<div class="site-footer__grid">
		<div class="footer-col footer-col--brand">
			<?php cpc_site_logo( 'footer' ); ?>
			<p><?php echo esc_html( cpc_copy( 'footer_text' ) ); ?></p>
		</div>

		<nav class="footer-col" aria-labelledby="footer-services-title">
			<h2 id="footer-services-title" class="footer-title"><?php esc_html_e( 'Servicios', 'cerrajeros-parla' ); ?></h2>
			<ul class="footer-list">
				<?php foreach ( cpc_services() as $cpc_service ) : ?>
					<li><a href="<?php echo esc_url( $cpc_service['url'] ); ?>"><?php echo esc_html( $cpc_service['title'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<div class="footer-col">
			<h2 class="footer-title"><?php esc_html_e( 'Contacto', 'cerrajeros-parla' ); ?></h2>
			<ul class="footer-list footer-contact">
				<li>
					<?php echo cpc_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<a class="footer-phone" href="<?php echo esc_url( cpc_phone_href() ); ?>" data-call="footer"><?php echo esc_html( CPC_PHONE_DISPLAY ); ?></a>
				</li>
				<li>
					<?php echo cpc_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<span><?php esc_html_e( 'Abierto 24 horas, todos los días', 'cerrajeros-parla' ); ?></span>
				</li>
				<li>
					<?php echo cpc_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
					<span>
						<?php esc_html_e( 'Parla (Madrid) y Madrid Sur', 'cerrajeros-parla' ); ?><br>
						<a href="<?php echo esc_url( CPC_MAPS_URL ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Ver en Google Maps', 'cerrajeros-parla' ); ?><span class="screen-reader-text"> <?php esc_html_e( '(se abre en una pestaña nueva)', 'cerrajeros-parla' ); ?></span></a>
					</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="site-footer__legal">
		<div class="site-footer__legal-inner">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( CPC_BRAND ); ?></p>
			<?php
			if ( has_nav_menu( 'footer-menu' ) ) {
				wp_nav_menu(
					array(
						'theme_location'       => 'footer-menu',
						'container'            => 'nav',
						'container_class'      => 'legal-nav',
						'container_aria_label' => __( 'Información legal', 'cerrajeros-parla' ),
						'menu_class'           => 'legal-menu',
						'depth'                => 1,
						'item_spacing'         => 'discard',
					)
				);
			} elseif ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<nav class="legal-nav"><ul class="legal-menu"><li>', '</li></ul></nav>' );
			}
			?>
		</div>
	</div>
</footer>

<?php get_template_part( 'template-parts/sticky-call' ); ?>

<?php wp_footer(); ?>
</body>
</html>
