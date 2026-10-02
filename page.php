<?php
/**
 * Default page template — "servicio-localidad" landing.
 *
 * Every landing has EXACTLY TWO photo slots:
 *   hero → [text 1 | photo 1] → angled divider → [photo 2 | text 2] → remaining texts → CTA
 *
 * Texts come from the "Huecos de texto" editors (inc/text-slots.php). When none is
 * filled, the main editor content is split in two instead: block 2 starts at the
 * "Read More" tag (<!--more-->) or, without it, near the middle.
 *
 * @package Cerrajeros_Parla
 */

get_header();

while ( have_posts() ) :
	the_post();

	$cpc_texts = cpc_get_texts();
	$cpc_title = wp_strip_all_tags( get_the_title() );

	if ( $cpc_texts['blocks'] || $cpc_texts['cta'] ) {
		$cpc_blocks = array_values( $cpc_texts['blocks'] );
		$cpc_copy_1 = array_shift( $cpc_blocks );
		$cpc_copy_2 = array_shift( $cpc_blocks );
		$cpc_rest   = $cpc_blocks;
	} else {
		list( $cpc_copy_1, $cpc_copy_2 ) = cpc_get_content_parts();
		$cpc_rest                        = array();
	}
	?>
	<main id="content" class="site-main">
		<?php
		get_template_part(
			'template-parts/hero',
			null,
			array(
				'title' => get_the_title(),
				'lead'  => cpc_get_lead_text(),
			)
		);
		?>

		<section class="grid-layout-2col section-block" aria-label="<?php echo esc_attr( $cpc_title ); ?>">
			<div class="copy-block-1 entry-content">
				<?php echo (string) $cpc_copy_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted content. ?>
			</div>
			<figure class="photo-slot photo-slot-1 card-steel">
				<?php cpc_photo_slot( 1, $cpc_title ); ?>
			</figure>
		</section>

		<div class="divider-angled" aria-hidden="true"></div>

		<section class="grid-layout-2col reverse-mobile section-block bg-steel" aria-label="<?php esc_attr_e( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ); ?>">
			<figure class="photo-slot photo-slot-2 card-steel">
				<?php cpc_photo_slot( 2, __( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ) ); ?>
			</figure>
			<div class="copy-block-2 entry-content">
				<?php if ( '' !== trim( wp_strip_all_tags( (string) $cpc_copy_2 ) ) || false !== strpos( (string) $cpc_copy_2, '<img' ) ) : ?>
					<?php echo $cpc_copy_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted content. ?>
				<?php else : ?>
					<h2><?php esc_html_e( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ); ?></h2>
					<p><?php esc_html_e( 'Cuéntanos por teléfono qué le pasa a tu puerta, cerradura o cierre metálico y te indicamos cómo lo resolvemos.', 'cerrajeros-parla' ); ?></p>
					<p><?php cpc_call_button( 'landing-fallback' ); ?></p>
				<?php endif; ?>

				<?php
				if ( ! $cpc_rest && ! $cpc_texts['cta'] ) {
					wp_link_pages(
						array(
							'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Páginas', 'cerrajeros-parla' ) . '">',
							'after'  => '</nav>',
						)
					);
					edit_post_link( __( 'Editar página', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' );
				}
				?>
			</div>
		</section>

		<?php if ( $cpc_rest || $cpc_texts['cta'] ) : ?>
			<div class="divider-angled divider-angled--down" aria-hidden="true"></div>

			<section class="section-block text-slots">
				<div class="wrap narrow">
					<?php foreach ( $cpc_rest as $cpc_html ) : ?>
						<div class="text-slot entry-content">
							<?php echo $cpc_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted slot HTML. ?>
						</div>
					<?php endforeach; ?>

					<?php cpc_cta_slot( $cpc_texts['cta'] ); ?>

					<?php edit_post_link( __( 'Editar página', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' ); ?>
				</div>
			</section>
		<?php endif; ?>
	</main>
	<?php
endwhile;

get_footer();
