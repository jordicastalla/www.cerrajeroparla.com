<?php
/**
 * Default page template — "servicio-localidad" landing.
 *
 * Every landing has EXACTLY TWO photo slots:
 *   hero → [copy block 1 | photo 1] → angled divider → [photo 2 | copy block 2]
 *
 * Copy block 2 starts at the "Read More" tag (<!--more-->) inserted in the editor;
 * without it the content is split automatically near the middle.
 * Photo 1 = "Foto 1" meta box (or the featured image); photo 2 = "Foto 2" meta box.
 *
 * @package Cerrajeros_Parla
 */

get_header();

while ( have_posts() ) :
	the_post();

	list( $cpc_copy_1, $cpc_copy_2 ) = cpc_get_content_parts();
	$cpc_title                       = wp_strip_all_tags( get_the_title() );
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
				<?php echo $cpc_copy_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the_content output. ?>
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
				<?php if ( '' !== trim( wp_strip_all_tags( $cpc_copy_2 ) ) || false !== strpos( $cpc_copy_2, '<img' ) ) : ?>
					<?php echo $cpc_copy_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the_content output. ?>
				<?php else : ?>
					<h2><?php esc_html_e( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ); ?></h2>
					<p><?php esc_html_e( 'Cuéntanos por teléfono qué le pasa a tu puerta, cerradura o cierre metálico y te indicamos cómo lo resolvemos.', 'cerrajeros-parla' ); ?></p>
					<p><?php cpc_call_button( 'landing-fallback' ); ?></p>
				<?php endif; ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Páginas', 'cerrajeros-parla' ) . '">',
						'after'  => '</nav>',
					)
				);
				edit_post_link( __( 'Editar página', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' );
				?>
			</div>
		</section>
	</main>
	<?php
endwhile;

get_footer();
