<?php
/**
 * Default page template — "servicio-localidad" landing.
 *
 * Every landing has EXACTLY TWO photo slots. With the "Huecos de texto" editors
 * (inc/text-slots.php) the order is:
 *   hero → INTRO → [section | photo 1] → divider → SECTION → [photo 2 | section] → rest → CTA
 *
 * When no slot is filled, the main editor content is split in two instead:
 *   hero → [copy 1 | photo 1] → divider → [photo 2 | copy 2]
 * Block 2 starts at the "Read More" tag (<!--more-->) or, without it, near the middle.
 *
 * @package Cerrajeros_Parla
 */

get_header();

while ( have_posts() ) :
	the_post();

	$cpc_texts = cpc_get_texts();
	$cpc_title = wp_strip_all_tags( get_the_title() );
	$cpc_slots = $cpc_texts['blocks'] || $cpc_texts['cta'];

	if ( $cpc_slots ) {
		// Text slots: INTRO → SECTION | PHOTO 1 → SECTION → PHOTO 2 | SECTION → rest → CTA.
		$cpc_blocks = array_values( $cpc_texts['blocks'] );
		$cpc_intro  = (string) array_shift( $cpc_blocks );
		$cpc_copy_1 = (string) array_shift( $cpc_blocks );
		$cpc_middle = (string) array_shift( $cpc_blocks );
		$cpc_copy_2 = (string) array_shift( $cpc_blocks );
		$cpc_rest   = $cpc_blocks;
	} else {
		// Main editor split in two: [copy 1 | photo 1] → [photo 2 | copy 2].
		list( $cpc_copy_1, $cpc_copy_2 ) = cpc_get_content_parts();
		$cpc_intro                       = '';
		$cpc_middle                      = '';
		$cpc_rest                        = array();
	}
	$cpc_has_copy_2 = '' !== trim( wp_strip_all_tags( (string) $cpc_copy_2 ) ) || false !== strpos( (string) $cpc_copy_2, '<img' );
	$cpc_tail       = $cpc_rest || '' !== $cpc_texts['cta'];
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

		<?php if ( '' !== $cpc_intro ) : ?>
			<section class="section-block text-slots slot-intro">
				<div class="wrap narrow text-slot entry-content">
					<?php echo $cpc_intro; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted slot HTML. ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="grid-layout-2col section-block" aria-label="<?php echo esc_attr( $cpc_title ); ?>">
			<div class="copy-block-1 entry-content">
				<?php echo (string) $cpc_copy_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted content. ?>
			</div>
			<figure class="photo-slot photo-slot-1 card-steel">
				<?php cpc_photo_slot( 1, $cpc_title ); ?>
			</figure>
		</section>

		<div class="divider-angled" aria-hidden="true"></div>

		<?php if ( '' !== $cpc_middle ) : ?>
			<section class="section-block bg-steel text-slots slot-middle">
				<div class="wrap narrow text-slot entry-content">
					<?php echo $cpc_middle; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted slot HTML. ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="grid-layout-2col reverse-mobile section-block bg-steel" aria-label="<?php echo esc_attr( cpc_copy( 'alt_2' ) ); ?>">
			<figure class="photo-slot photo-slot-2 card-steel">
				<?php cpc_photo_slot( 2, cpc_copy( 'alt_2' ) ); ?>
			</figure>
			<div class="copy-block-2 entry-content">
				<?php if ( $cpc_has_copy_2 ) : ?>
					<?php echo $cpc_copy_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted content. ?>
				<?php else : ?>
					<h2><?php echo esc_html( cpc_copy( 'fallback_h2' ) ); ?></h2>
					<p><?php echo esc_html( cpc_copy( 'fallback_p' ) ); ?></p>
					<p><?php cpc_call_button( 'landing-fallback' ); ?></p>
				<?php endif; ?>

				<?php
				if ( ! $cpc_tail ) {
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

		<?php if ( $cpc_tail ) : ?>
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
