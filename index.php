<?php
/**
 * Fallback template: blog, archives and search results.
 *
 * @package Cerrajeros_Parla
 */

get_header();

if ( is_search() ) {
	/* translators: %s: search query. */
	$cpc_title = sprintf( __( 'Resultados para «%s»', 'cerrajeros-parla' ), get_search_query() );
} elseif ( is_home() ) {
	$cpc_blog  = (int) get_option( 'page_for_posts' );
	$cpc_title = $cpc_blog ? get_the_title( $cpc_blog ) : __( 'Blog', 'cerrajeros-parla' );
} elseif ( is_archive() ) {
	$cpc_title = wp_strip_all_tags( get_the_archive_title() );
} else {
	$cpc_title = __( 'Cerrajeros en Parla', 'cerrajeros-parla' );
}
?>
<main id="content" class="site-main">
	<?php
	get_template_part(
		'template-parts/hero',
		null,
		array(
			'title' => esc_html( $cpc_title ),
			'lead'  => is_archive() ? get_the_archive_description() : '',
			'cta'   => false,
		)
	);
	?>

	<section class="section-block">
		<div class="wrap">
			<?php if ( have_posts() ) : ?>
				<ul class="post-list">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<li <?php post_class( 'post-card card-steel' ); ?>>
							<?php if ( 'post' === get_post_type() ) : ?>
								<p class="post-card__meta"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
							<?php endif; ?>
							<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
							<span class="service-card__more" aria-hidden="true">
								<?php esc_html_e( 'Leer más', 'cerrajeros-parla' ); ?>
								<?php echo cpc_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
							</span>
						</li>
					<?php endwhile; ?>
				</ul>

				<?php
				the_posts_pagination(
					array(
						'mid_size'           => 1,
						'prev_text'          => __( 'Anterior', 'cerrajeros-parla' ),
						'next_text'          => __( 'Siguiente', 'cerrajeros-parla' ),
						'aria_label'         => __( 'Paginación', 'cerrajeros-parla' ),
						'screen_reader_text' => __( 'Navegación de entradas', 'cerrajeros-parla' ),
					)
				);
				?>
			<?php else : ?>
				<div class="entry-content narrow">
					<p><?php esc_html_e( 'No hemos encontrado contenido aquí. Estos son nuestros servicios en Parla:', 'cerrajeros-parla' ); ?></p>
				</div>
				<?php get_template_part( 'template-parts/services-grid', null, array( 'heading_level' => 'h2' ) ); ?>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
