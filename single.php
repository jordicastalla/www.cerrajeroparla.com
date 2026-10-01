<?php
/**
 * Single post.
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
				'lead'    => has_excerpt() ? wpautop( wp_kses_post( get_the_excerpt() ) ) : '',
				'eyebrow' => get_the_date(),
				'cta'     => false,
			)
		);
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'section-block' ); ?>>
			<div class="wrap entry-content narrow">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="post-thumbnail card-steel"><?php the_post_thumbnail( 'cpc-photo', array( 'alt' => wp_strip_all_tags( get_the_title() ) ) ); ?></figure>
				<?php endif; ?>

				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Páginas', 'cerrajeros-parla' ) . '">',
						'after'  => '</nav>',
					)
				);
				edit_post_link( __( 'Editar entrada', 'cerrajeros-parla' ), '<p class="edit-link">', '</p>' );
				?>
			</div>
		</article>
	</main>
	<?php
endwhile;

get_footer();
