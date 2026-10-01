<?php
/**
 * 404: page not found, with the three services and the call button.
 *
 * @package Cerrajeros_Parla
 */

get_header();
?>
<main id="content" class="site-main">
	<?php
	get_template_part(
		'template-parts/hero',
		null,
		array(
			'title'   => __( 'Página no encontrada', 'cerrajeros-parla' ),
			'lead'    => '<p>' . esc_html__( 'Esta dirección no existe o ha cambiado. Si necesitas un cerrajero en Parla, llámanos ahora o elige un servicio.', 'cerrajeros-parla' ) . '</p>',
			'eyebrow' => __( 'Error 404', 'cerrajeros-parla' ),
		)
	);
	?>

	<section class="section-block" aria-labelledby="servicios-404">
		<div class="wrap">
			<header class="section-head">
				<p class="section-kicker"><?php esc_html_e( 'Servicios', 'cerrajeros-parla' ); ?></p>
				<h2 id="servicios-404"><?php esc_html_e( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ); ?></h2>
			</header>
			<?php get_template_part( 'template-parts/services-grid' ); ?>
		</div>
	</section>
</main>
<?php
get_footer();
