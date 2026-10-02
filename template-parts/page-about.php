<?php
/**
 * "Quiénes somos": two short texts and a single photo.
 *   hero → [text 1 | photo] → text 2
 *
 * @package Cerrajeros_Parla
 */

$cpc_texts = cpc_get_texts();
$cpc_text1 = isset( $cpc_texts['blocks']['texto_1'] ) ? $cpc_texts['blocks']['texto_1'] : '';
$cpc_text2 = isset( $cpc_texts['blocks']['texto_2'] ) ? $cpc_texts['blocks']['texto_2'] : '';

// Without slot texts, the main editor content fills text 1.
if ( '' === $cpc_text1 && '' === $cpc_text2 ) {
	$cpc_text1 = apply_filters( 'the_content', get_the_content() );
}
?>
<main id="content" class="site-main page-about">
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

	<section class="grid-layout-2col section-block" aria-label="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>">
		<div class="copy-block-1 entry-content">
			<?php cpc_slot_or_hint( $cpc_text1, __( 'Texto 1', 'cerrajeros-parla' ) ); ?>
		</div>
		<figure class="photo-slot photo-slot-1 card-steel">
			<?php cpc_photo_slot( 1, CPC_BRAND ); ?>
		</figure>
	</section>

	<?php if ( '' !== $cpc_text2 || current_user_can( 'edit_post', get_the_ID() ) ) : ?>
		<section class="section-block text-slots">
			<div class="wrap narrow text-slot entry-content">
				<?php cpc_slot_or_hint( $cpc_text2, __( 'Texto 2', 'cerrajeros-parla' ) ); ?>
				<?php edit_post_link( __( 'Editar página', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' ); ?>
			</div>
		</section>
	<?php endif; ?>
</main>
