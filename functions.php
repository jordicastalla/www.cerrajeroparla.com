<?php
/**
 * Parla Cerrajeros CP — theme bootstrap.
 *
 * "Industrial Gold & Steel" theme for cerrajeroparla.com: phone-only
 * conversion, local SEO, vanilla CSS and native template hierarchy.
 *
 * @package Cerrajeros_Parla
 */

defined( 'ABSPATH' ) || exit;

/*--------------------------------------------------------------
# Business data (single source of truth for every template)
--------------------------------------------------------------*/
define( 'CPC_VERSION', '2.0.0' );
define( 'CPC_BRAND', 'Parla Cerrajeros CP' );
define( 'CPC_PHONE_DISPLAY', '919 93 26 78' );
define( 'CPC_PHONE_TEL', '+34919932678' );
define( 'CPC_MAPS_URL', 'https://maps.app.goo.gl/B6aewJE3C5fAn1fb9' );
define( 'CPC_LOCALITY', 'Parla' );
define( 'CPC_LANG', 'es-ES' ); // Front-end language, independent of the admin language.

/*--------------------------------------------------------------
# Theme setup
--------------------------------------------------------------*/

/**
 * Registers theme supports, menus and image sizes.
 */
function cpc_setup() {
	load_theme_textdomain( 'cerrajeros-parla', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

	// The golden Avutarda logo will be uploaded later; until then header.php prints a typographic logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 64,
			'width'       => 260,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'main-menu'   => __( 'Menú principal', 'cerrajeros-parla' ),
			'footer-menu' => __( 'Menú legal (pie de página)', 'cerrajeros-parla' ),
		)
	);

	// Landing-page photo slots: 4:3, hard crop.
	add_image_size( 'cpc-photo', 1200, 900, true );

	add_post_type_support( 'page', 'excerpt' );

	// TinyMCE splits content_css on commas, so encode the ones inside the Google Fonts URL.
	add_editor_style( array( 'editor-style.css', str_replace( ',', '%2C', cpc_fonts_url() ) ) );
}
add_action( 'after_setup_theme', 'cpc_setup' );

/**
 * Removes emoji scripts/styles and other <head> noise.
 */
function cpc_clean_head() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' ); // Also drops the s.w.org dns-prefetch hint.
}
add_action( 'after_setup_theme', 'cpc_clean_head' );

/**
 * Removes the emoji plugin from TinyMCE.
 *
 * @param array $plugins TinyMCE plugins.
 * @return array
 */
function cpc_disable_emoji_tinymce( $plugins ) {
	return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
}
add_filter( 'tiny_mce_plugins', 'cpc_disable_emoji_tinymce' );

/**
 * Forces <html lang="es-ES"> on the front end, even when ClassicPress runs in English.
 *
 * @param string $output Attributes from language_attributes().
 * @return string
 */
function cpc_force_lang( $output ) {
	if ( is_admin() ) {
		return $output;
	}

	$lang = 'lang="' . esc_attr( CPC_LANG ) . '"';

	return preg_match( '/\blang="[^"]*"/', $output )
		? preg_replace( '/\blang="[^"]*"/', $lang, $output )
		: trim( $output . ' ' . $lang );
}
add_filter( 'language_attributes', 'cpc_force_lang' );

// Phone calls only: no comment or pingback forms anywhere on the site.
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );

/*--------------------------------------------------------------
# Assets
--------------------------------------------------------------*/

/**
 * Google Fonts: Outfit (display) + DM Sans (body).
 *
 * @return string
 */
function cpc_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=Outfit:wght@500;700;900&display=swap';
}

/**
 * Enqueues front-end styles and the tiny navigation script.
 */
function cpc_assets() {
	// Null version: WordPress must not append ?ver= to the Google Fonts URL.
	wp_enqueue_style( 'cpc-fonts', cpc_fonts_url(), array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_style( 'cpc-style', get_template_directory_uri() . '/style.css', array( 'cpc-fonts' ), CPC_VERSION );
	if ( is_child_theme() ) {
		wp_enqueue_style( 'cpc-child-style', get_stylesheet_uri(), array( 'cpc-style' ), CPC_VERSION );
	}

	wp_enqueue_script( 'cpc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), CPC_VERSION, true );

	wp_deregister_script( 'wp-embed' );
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}

	// Classic content does not need block-editor CSS.
	if ( ! ( is_singular() && function_exists( 'has_blocks' ) && has_blocks() ) ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'global-styles' );
	}
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'cpc_assets', 20 );

/**
 * Keeps our own cache-busting version when ClassicPress rewrites asset versions.
 *
 * @param string $version Asset version.
 * @param string $type    'script' or 'style'.
 * @param string $handle  Asset handle.
 * @return string
 */
function cpc_asset_version( $version, $type, $handle ) {
	return in_array( $handle, array( 'cpc-style', 'cpc-child-style', 'cpc-navigation' ), true ) ? CPC_VERSION : $version;
}
add_filter( 'classicpress_asset_version', 'cpc_asset_version', 10, 3 );

/*--------------------------------------------------------------
# Business helpers
--------------------------------------------------------------*/

/**
 * The tel: URI used by every call button.
 *
 * @return string
 */
function cpc_phone_href() {
	return 'tel:' . CPC_PHONE_TEL;
}

/**
 * Prints a gold call button.
 *
 * @param string $location Where the button lives (exposed as data-call for analytics).
 * @param string $label    Button text. Defaults to "Llamar: 919 93 26 78".
 * @param string $class    Extra CSS classes.
 */
function cpc_call_button( $location, $label = '', $class = '' ) {
	if ( '' === $label ) {
		/* translators: %s: phone number. */
		$label = sprintf( __( 'Llamar: %s', 'cerrajeros-parla' ), CPC_PHONE_DISPLAY );
	}

	printf(
		'<a class="%1$s" href="%2$s" data-call="%3$s">%4$s<span>%5$s</span></a>',
		esc_attr( trim( 'btn-gold ' . $class ) ),
		esc_url( cpc_phone_href() ),
		esc_attr( $location ),
		cpc_icon( 'bolt' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG.
		esc_html( $label )
	);
}

/**
 * The three core services. Each URL resolves to its "servicio-localidad" page.
 *
 * @return array[]
 */
function cpc_services() {
	static $services = null;

	if ( null !== $services ) {
		return $services;
	}

	$services = array(
		array(
			'slug' => 'cambio-de-cerradura-parla',
			'name' => __( 'Cambio de Cerradura', 'cerrajeros-parla' ),
			'menu' => __( 'Cambio de cerradura', 'cerrajeros-parla' ),
			'text' => __( 'Si pierdes la llave o el bombín falla, recupera el control de tu puerta.', 'cerrajeros-parla' ),
			'icon' => 'padlock',
		),
		array(
			'slug' => 'instalacion-de-cerrojos-parla',
			'name' => __( 'Instalación de Cerrojos', 'cerrajeros-parla' ),
			'menu' => __( 'Cerrojos', 'cerrajeros-parla' ),
			'text' => __( 'Un punto de cierre más para que tu puerta sea más difícil de forzar.', 'cerrajeros-parla' ),
			'icon' => 'deadbolt',
		),
		array(
			'slug' => 'reparacion-cierres-metalicos-parla',
			'name' => __( 'Reparación Cierres Metálicos', 'cerrajeros-parla' ),
			'menu' => __( 'Cierres metálicos', 'cerrajeros-parla' ),
			'text' => __( 'Para comercios, locales y garajes cuya persiana no sube o no baja.', 'cerrajeros-parla' ),
			'icon' => 'shutter',
		),
	);

	foreach ( $services as $i => $service ) {
		$page                    = get_page_by_path( $service['slug'] );
		$services[ $i ]['url']   = $page ? get_permalink( $page ) : home_url( user_trailingslashit( $service['slug'] ) );
		$services[ $i ]['title'] = $service['name'] . ' ' . CPC_LOCALITY; // The page H1: "servicio localidad".
	}

	$services = apply_filters( 'cpc_services', $services );

	return $services;
}

/**
 * Inline SVG icons (stroke-based, square caps for an industrial look).
 *
 * @param string $name  Icon name.
 * @param string $class Extra CSS classes.
 * @return string Static, safe SVG markup.
 */
function cpc_icon( $name, $class = '' ) {
	$icons = array(
		'phone'    => '<path d="M5.2 3.5h3.6l1.7 4.6-2.3 1.6a12 12 0 0 0 6.1 6.1l1.6-2.3 4.6 1.7v3.6a1.7 1.7 0 0 1-1.8 1.7C10.8 20.1 3.9 13.2 3.5 5.3a1.7 1.7 0 0 1 1.7-1.8Z"/>',
		'bolt'     => '<path d="M13.6 2 4.5 13.4h6.3L9.9 22l9.6-11.6h-6.4L13.6 2Z" fill="currentColor" stroke="none"/>',
		'padlock'  => '<rect x="4.5" y="10.5" width="15" height="10" rx="1"/><path d="M8 10.5v-3a4 4 0 0 1 8 0v3"/><path d="M12 14.5v2.5"/>',
		'deadbolt' => '<rect x="2.5" y="7" width="11" height="10" rx="1"/><path d="M13.5 10.5h5.5v3h-5.5"/><path d="M21.5 6v12"/><circle cx="8" cy="12" r="1.5"/>',
		'shutter'  => '<path d="M2.5 4h19"/><path d="M4 4v16.5M20 4v16.5"/><path d="M4 8h16M4 11.5h16M4 15h16"/><path d="M10 18.5h4"/>',
		'key'      => '<circle cx="7.5" cy="16" r="4"/><path d="M10.4 13.1 20 3.5"/><path d="m16.5 7 3 3M14 9.5l2 2"/>',
		'pin'      => '<path d="M12 21.5s-7-6.3-7-11.5a7 7 0 0 1 14 0c0 5.2-7 11.5-7 11.5Z"/><circle cx="12" cy="10" r="2.5"/>',
		'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
		'shield'   => '<path d="M12 2.8 4.5 5.6v6c0 4.6 3.2 8.4 7.5 9.6 4.3-1.2 7.5-5 7.5-9.6v-6Z"/><path d="m8.8 12 2.2 2.2 4.2-4.4"/>',
		'arrow'    => '<path d="M4 12h15"/><path d="m13 6 6 6-6 6"/>',
		'menu'     => '<path d="M3 6h18M3 12h18M3 18h18"/>',
		'close'    => '<path d="m5 5 14 14M19 5 5 19"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="icon icon-%1$s %2$s" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		esc_attr( $class ),
		$icons[ $name ]
	);
}

/**
 * Prints the logo: the uploaded custom logo, or the typographic "Parla Cerrajeros CP" lockup.
 *
 * @param string $context 'header' or 'footer'.
 */
function cpc_site_logo( $context = 'header' ) {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	printf(
		'<a class="site-logo site-logo--%1$s" href="%2$s" rel="home" aria-label="%3$s"><span class="site-logo__text" aria-hidden="true"><span class="site-logo__top">Parla</span><span class="site-logo__main">Cerrajeros</span></span><span class="site-logo__cp" aria-hidden="true">CP</span></a>',
		esc_attr( $context ),
		esc_url( home_url( '/' ) ),
		/* translators: %s: brand name. */
		esc_attr( sprintf( __( '%s — Inicio', 'cerrajeros-parla' ), CPC_BRAND ) )
	);
}

/**
 * Main menu fallback: home + the three service landings.
 */
function cpc_menu_fallback() {
	echo '<ul id="primary-menu" class="menu">';

	printf(
		'<li class="menu-item"><a href="%1$s"%2$s>%3$s</a></li>',
		esc_url( home_url( '/' ) ),
		is_front_page() ? ' aria-current="page"' : '',
		esc_html__( 'Inicio', 'cerrajeros-parla' )
	);

	foreach ( cpc_services() as $service ) {
		printf(
			'<li class="menu-item"><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $service['url'] ),
			is_page( $service['slug'] ) ? ' aria-current="page"' : '',
			esc_html( $service['menu'] )
		);
	}

	echo '</ul>';
}

/**
 * Hero lead text: the page excerpt, or a default call-to-action line.
 *
 * @return string HTML.
 */
function cpc_get_lead_text() {
	if ( has_excerpt() ) {
		return wpautop( wp_kses_post( get_the_excerpt() ) );
	}

	$lead = cpc_copy( 'lead' ); // Default lead of the page type (inc/text-slots.php).

	return '' === $lead ? '' : '<p>' . esc_html( $lead ) . '</p>';
}

/**
 * Schema.org Locksmith data printed as JSON-LD in header.php.
 *
 * @return array
 */
function cpc_schema_data() {
	$data = array(
		'@context'                  => 'https://schema.org',
		'@type'                     => 'Locksmith',
		'name'                      => CPC_BRAND,
		'url'                       => home_url( '/' ),
		'telephone'                 => CPC_PHONE_TEL,
		'priceRange'                => '€€',
		'address'                   => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Parla',
			'addressRegion'   => 'Madrid',
			'addressCountry'  => 'ES',
		),
		'openingHoursSpecification' => array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
			'opens'     => '00:00',
			'closes'    => '23:59',
		),
		'areaServed'                => array( 'Parla', 'Madrid Sur' ),
		'hasMap'                    => CPC_MAPS_URL,
		'knowsLanguage'             => CPC_LANG,
	);

	// Once the Avutarda logo is uploaded it becomes the business logo/image automatically.
	if ( has_custom_logo() ) {
		$logo = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
		if ( $logo ) {
			$data['logo']  = $logo;
			$data['image'] = $logo;
		}
	}

	return apply_filters( 'cpc_schema_data', $data );
}

/*--------------------------------------------------------------
# Landing pages: two content blocks + two photo slots
--------------------------------------------------------------*/

/**
 * Splits the current post content into the two copy blocks of page.php.
 *
 * The editor decides where block 2 starts with the "Read More" tag (<!--more-->).
 * Without it, the content is split automatically at a top-level element near the
 * middle, preferring an <h2>/<h3>. The_content filters run only once.
 *
 * @return string[] Two HTML strings; the second may be empty.
 */
function cpc_get_content_parts() {
	$content = apply_filters( 'the_content', get_the_content() );
	$content = str_replace( ']]>', ']]&gt;', $content );

	// On singular views WordPress replaces <!--more--> with <span id="more-ID"></span>.
	$marker = '#(?:<p>\s*)?<span id="more-\d+"></span>(?:\s*</p>)?#i';
	if ( preg_match( $marker, $content ) ) {
		$parts = preg_split( $marker, $content, 2 );
		return array( force_balance_tags( trim( $parts[0] ) ), force_balance_tags( trim( $parts[1] ) ) );
	}

	return cpc_split_html( $content );
}

/**
 * Splits rendered HTML in two at a top-level element boundary, never inside an element.
 *
 * @param string $html Rendered HTML.
 * @return string[] Two HTML strings; the second is empty when no safe boundary exists.
 */
function cpc_split_html( $html ) {
	$html = trim( (string) $html );
	if ( '' === $html ) {
		return array( '', '' );
	}

	$void  = array( 'area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr' );
	$attrs = '(?:[^>"\']|"[^"]*"|\'[^\']*\')*';
	$regex = '#<!--.*?-->|<(script|style|textarea)\b' . $attrs . '>.*?</\1\s*>|<(/?)([a-z][a-z0-9:-]*)\b(' . $attrs . ')>#is';

	preg_match_all( $regex, $html, $tokens, PREG_SET_ORDER | PREG_OFFSET_CAPTURE );

	// Byte offsets where a top-level element starts => its tag name.
	$cuts  = array();
	$depth = 0;
	foreach ( $tokens as $token ) {
		$offset = $token[0][1];

		if ( 0 === strpos( $token[0][0], '<!--' ) ) {
			continue;
		}

		if ( isset( $token[1] ) && '' !== $token[1][0] ) { // <script>, <style>, <textarea>: atomic.
			if ( 0 === $depth && $offset > 0 ) {
				$cuts[ $offset ] = strtolower( $token[1][0] );
			}
			continue;
		}

		$name = strtolower( $token[3][0] );

		if ( '/' === $token[2][0] ) {
			$depth = max( 0, $depth - 1 );
			continue;
		}

		if ( 0 === $depth && $offset > 0 ) {
			$cuts[ $offset ] = $name;
		}

		$self_closing = '/' === substr( rtrim( $token[4][0] ), -1 );
		if ( ! in_array( $name, $void, true ) && ! $self_closing ) {
			++$depth;
		}
	}

	if ( empty( $cuts ) ) {
		return array( $html, '' );
	}

	// Visible text length before each candidate cut.
	$before = array();
	$text   = 0;
	$prev   = 0;
	foreach ( array_keys( $cuts ) as $offset ) {
		$text            += strlen( wp_strip_all_tags( substr( $html, $prev, $offset - $prev ) ) );
		$before[ $offset ] = $text;
		$prev             = $offset;
	}
	$total = $text + strlen( wp_strip_all_tags( substr( $html, $prev ) ) );

	$best       = null;
	$best_score = PHP_INT_MAX;
	foreach ( $cuts as $offset => $name ) {
		if ( 0 === $before[ $offset ] ) {
			continue; // Block 1 must contain some text.
		}

		$ratio = $total > 0 ? $before[ $offset ] / $total : $offset / strlen( $html );
		$score = abs( 0.5 - $ratio );
		if ( in_array( $name, array( 'h2', 'h3' ), true ) ) {
			$score -= 0.15; // A heading close to the middle beats a paragraph exactly in the middle.
		}

		if ( $score < $best_score ) {
			$best       = $offset;
			$best_score = $score;
		}
	}

	if ( null === $best ) {
		return array( $html, '' );
	}

	return array( rtrim( substr( $html, 0, $best ) ), substr( $html, $best ) );
}

/**
 * Attachment ID for a photo slot. Slot 1 falls back to the featured image.
 *
 * @param int      $slot    1 or 2.
 * @param int|null $post_id Page ID.
 * @return int
 */
function cpc_get_photo_id( $slot, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$id      = absint( get_post_meta( $post_id, '_cpc_photo_' . $slot, true ) );

	if ( ! $id && 1 === $slot ) {
		$id = (int) get_post_thumbnail_id( $post_id );
	}

	return ( $id && wp_attachment_is_image( $id ) ) ? $id : 0;
}

/**
 * Prints the inside of a photo slot: the image, or a reserved placeholder plate.
 *
 * @param int    $slot 1 or 2.
 * @param string $alt  Alt text for the image.
 */
function cpc_photo_slot( $slot, $alt ) {
	$id = cpc_get_photo_id( $slot );

	if ( $id ) {
		echo wp_get_attachment_image(
			$id,
			'cpc-photo',
			false,
			array(
				'alt'      => $alt,
				'class'    => 'photo-slot__img',
				'loading'  => 'lazy',
				'decoding' => 'async',
				'sizes'    => '(min-width: 900px) 560px, 100vw',
			)
		);
		return;
	}
	?>
	<div class="photo-slot__placeholder">
		<?php echo cpc_icon( 1 === $slot ? 'padlock' : 'key' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
		<span class="photo-slot__brand" aria-hidden="true">Parla Cerrajeros <b>CP</b></span>
		<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) : ?>
			<span class="photo-slot__hint">
				<?php
				/* translators: %d: photo slot number. */
				printf( esc_html__( 'Hueco de foto %d reservado: asígnala en la caja «Fotos de la página» del editor.', 'cerrajeros-parla' ), (int) $slot );
				?>
			</span>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Uses the legal-text template for the privacy policy page unless another template was chosen.
 *
 * @param string $template Template path.
 * @return string
 */
function cpc_privacy_page_template( $template ) {
	$page_id = get_queried_object_id();

	if ( $page_id && (int) get_option( 'wp_page_for_privacy_policy' ) === $page_id && ! get_page_template_slug( $page_id ) ) {
		$legal = locate_template( 'template-legal.php' );
		if ( $legal ) {
			return $legal;
		}
	}

	return $template;
}
add_filter( 'page_template', 'cpc_privacy_page_template' );

require get_template_directory() . '/inc/text-slots.php';

/*--------------------------------------------------------------
# Admin: photo slots meta box + "servicio-localidad" check
--------------------------------------------------------------*/

/**
 * Adds the photo meta box to every page (the home uses the two photos too).
 *
 * @param WP_Post $post Page being edited.
 */
function cpc_add_photo_meta_box( $post ) {
	add_meta_box( 'cpc-photos', __( 'Fotos de la página', 'cerrajeros-parla' ), 'cpc_render_photo_meta_box', 'page', 'side' );
}
add_action( 'add_meta_boxes_page', 'cpc_add_photo_meta_box' );

/**
 * Renders the photo meta box.
 *
 * @param WP_Post $post Page being edited.
 */
function cpc_render_photo_meta_box( $post ) {
	wp_nonce_field( 'cpc_save_photos', 'cpc_photos_nonce' );

	foreach ( range( 1, cpc_photo_count( $post->ID ) ) as $slot ) {
		$id      = absint( get_post_meta( $post->ID, '_cpc_photo_' . $slot, true ) );
		$preview = $id ? wp_get_attachment_image_url( $id, 'medium' ) : '';
		?>
		<div class="cpc-photo-field" style="margin-bottom:16px">
			<p style="margin:0 0 6px"><strong>
				<?php
				/* translators: %d: photo slot number. */
				printf( esc_html__( 'Foto %d', 'cerrajeros-parla' ), (int) $slot );
				?>
			</strong>
			<?php if ( 1 === $slot ) : ?>
				<br><span class="description"><?php esc_html_e( 'Vacía = se usa la imagen destacada.', 'cerrajeros-parla' ); ?></span>
			<?php endif; ?>
			</p>
			<div class="cpc-photo-preview">
				<?php if ( $preview ) : ?>
					<img src="<?php echo esc_url( $preview ); ?>" alt="" style="max-width:100%;height:auto;display:block;margin-bottom:6px">
				<?php endif; ?>
			</div>
			<input type="hidden" name="cpc_photo_<?php echo (int) $slot; ?>" value="<?php echo $id ? (int) $id : ''; ?>">
			<button type="button" class="button cpc-photo-select"><?php esc_html_e( 'Elegir imagen', 'cerrajeros-parla' ); ?></button>
			<button type="button" class="button-link cpc-photo-remove" <?php echo $id ? '' : 'hidden'; ?>><?php esc_html_e( 'Quitar', 'cerrajeros-parla' ); ?></button>
		</div>
		<?php
	}

	// SEO pattern check: H1 "Servicio Localidad" and slug /servicio-localidad.
	$title    = trim( wp_strip_all_tags( $post->post_title ) );
	$expected = sanitize_title( $title );
	$h1_ok    = (bool) preg_match( '/\b' . preg_quote( CPC_LOCALITY, '/' ) . '$/u', $title );
	$slug_ok  = '' !== $post->post_name && $expected === $post->post_name;
	?>
	<hr>
	<p style="margin:0 0 6px"><strong><?php esc_html_e( 'Patrón SEO servicio-localidad', 'cerrajeros-parla' ); ?></strong></p>
	<p style="margin:0 0 4px">
		<?php echo $h1_ok ? '&#10004;' : '&#10008;'; ?>
		<?php
		/* translators: %s: locality. */
		printf( esc_html__( 'El título (H1) termina en «%s»', 'cerrajeros-parla' ), esc_html( CPC_LOCALITY ) );
		?>
	</p>
	<p style="margin:0">
		<?php echo $slug_ok ? '&#10004;' : '&#10008;'; ?>
		<?php esc_html_e( 'La URL coincide con el título', 'cerrajeros-parla' ); ?>
		<?php if ( ! $slug_ok && '' !== $expected ) : ?>
			<br><code>/<?php echo esc_html( $expected ); ?>/</code>
		<?php endif; ?>
	</p>
	<p class="description"><?php esc_html_e( 'Solo aplica a las landings de servicio (no a textos legales).', 'cerrajeros-parla' ); ?></p>
	<?php
}

/**
 * Saves the photo slot attachment IDs.
 *
 * @param int $post_id Page ID.
 */
function cpc_save_photo_meta( $post_id ) {
	if ( ! isset( $_POST['cpc_photos_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cpc_photos_nonce'] ) ), 'cpc_save_photos' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( array( 1, 2 ) as $slot ) {
		$key = 'cpc_photo_' . $slot;
		if ( ! isset( $_POST[ $key ] ) ) {
			continue; // Slot not shown for this page type (e.g. "Quiénes somos" has one photo).
		}
		$id = absint( $_POST[ $key ] );

		if ( $id && wp_attachment_is_image( $id ) ) {
			update_post_meta( $post_id, '_cpc_photo_' . $slot, $id );
		} else {
			delete_post_meta( $post_id, '_cpc_photo_' . $slot );
		}
	}
}
add_action( 'save_post_page', 'cpc_save_photo_meta' );

/**
 * Loads the media picker on the page editor.
 *
 * @param string $hook Admin page hook.
 */
function cpc_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) || ! $screen || 'page' !== $screen->post_type ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script( 'cpc-admin-photos', get_template_directory_uri() . '/js/admin-photos.js', array( 'jquery' ), CPC_VERSION, true );
	wp_localize_script(
		'cpc-admin-photos',
		'cpcPhotos',
		array(
			'title'  => __( 'Elegir foto para la landing', 'cerrajeros-parla' ),
			'button' => __( 'Usar esta foto', 'cerrajeros-parla' ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'cpc_admin_assets' );
