<?php
/**
 * Template Name: Texto legal (sin fotos)
 *
 * Single-column layout for legal pages (aviso legal, privacidad, cookies).
 * Service landings must keep the default template, which has the two photo slots.
 *
 * @package Cerrajeros_Parla
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="content" class="site-main">
		<?php
		get_template_part(
			'template-parts/hero',
			null,
			array(
				'title'   => get_the_title(),
				'eyebrow' => CPC_BRAND,
				'cta'     => false,
			)
		);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'section-block' ); ?>>
			<div class="wrap entry-content narrow">
				<?php
				the_content();
				edit_post_link( __( 'Editar página', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' );
				?>
			</div>
		</article>
	</main>
	<?php
endwhile;

get_footer();
