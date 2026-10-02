<?php
/**
 * Text slots: one Classic Editor (TinyMCE) per content section of each page type.
 *
 * Every page type has a fixed list of slots that follows its copywriting brief
 * (home, the three services, "Quiénes somos"). The last slot of every type is the CTA.
 * Slot HTML is stored in post meta `_cpc_text_{slot}`.
 *
 * @package Cerrajeros_Parla
 */

defined( 'ABSPATH' ) || exit;

/**
 * Page types and their text slots, in display order.
 *
 * Each slot: label (shown above its editor) and hint (what goes in it, from the brief).
 *
 * @return array[]
 */
function cpc_text_layouts() {
	$cta = array(
		'label' => __( 'CTA (llamada a la acción)', 'cerrajeros-parla' ),
		'hint'  => __( 'Titular con gancho + unos 4 párrafos para que llamen al 919 93 26 78. El botón de llamada se añade solo.', 'cerrajeros-parla' ),
	);

	$layouts = array(
		'home'      => array(
			'label' => __( 'Home', 'cerrajeros-parla' ),
			'slots' => array(
				'intro'      => array(
					'label' => __( 'Introducción', 'cerrajeros-parla' ),
					'hint'  => __( '«Cerrajeros Parla»: titular H2 + unos 4 párrafos. Quiénes somos y por qué confiar.', 'cerrajeros-parla' ),
				),
				'urgencias'  => array(
					'label' => __( '24 horas – Urgencias', 'cerrajeros-parla' ),
					'hint'  => __( 'Apertura de puertas urgente: 24 horas, 365 días, guardia.', 'cerrajeros-parla' ),
				),
				'economicos' => array(
					'label' => __( 'Cerrajeros económicos', 'cerrajeros-parla' ),
					'hint'  => __( 'Precio, transparencia y relación calidad-precio.', 'cerrajeros-parla' ),
				),
				'cta'        => $cta,
			),
		),
		'cerrojos'  => array(
			'label' => __( 'Instalación de cerraduras y cerrojos', 'cerrajeros-parla' ),
			'slots' => array(
				'intro'     => array(
					'label' => __( 'Introducción', 'cerrajeros-parla' ),
					'hint'  => __( '«Instalación de cerrojos de seguridad en Parla».', 'cerrajeros-parla' ),
				),
				'urgente'   => array(
					'label' => __( 'Servicio de instalación urgente y 24 horas', 'cerrajeros-parla' ),
					'hint'  => __( 'H2.', 'cerrajeros-parla' ),
				),
				'tipos'     => array(
					'label' => __( 'Tipos de cerrojos de seguridad', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: mecánicos (con y sin llave); electrónicos, invisibles e inteligentes; con alarma.', 'cerrajeros-parla' ),
				),
				'marcas'    => array(
					'label' => __( 'Alta seguridad anti-bumping y mejores marcas', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: FAC (946 UVE, 546 RP UVE); LINCE (7930R); SAG (CSI, EP30).', 'cerrajeros-parla' ),
				),
				'puertas'   => array(
					'label' => __( 'Cerrojos según el tipo de puerta', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: puertas de vivienda (madera, metálicas, blindadas, acorazadas); trasteros, furgonetas y persianas.', 'cerrajeros-parla' ),
				),
				'precios'   => array(
					'label' => __( 'Precios de instalación de cerrojos', 'cerrajeros-parla' ),
					'hint'  => __( 'H2.', 'cerrajeros-parla' ),
				),
				'cta'       => $cta,
			),
		),
		'cerradura' => array(
			'label' => __( 'Cambio de cerradura y bombín', 'cerrajeros-parla' ),
			'slots' => array(
				'intro'      => array(
					'label' => __( 'Introducción', 'cerrajeros-parla' ),
					'hint'  => __( '«Cambiar cerradura en Parla». Toda clase de cerraduras.', 'cerrajeros-parla' ),
				),
				'bombin'     => array(
					'label' => __( 'Cambiar bombín', 'cerrajeros-parla' ),
					'hint'  => __( 'Quizá no hace falta cambiar la cerradura entera; diferencia bombín / cerradura.', 'cerrajeros-parla' ),
				),
				'blindadas'  => array(
					'label' => __( 'Puertas blindadas o acorazadas', 'cerrajeros-parla' ),
					'hint'  => __( 'Cambio de cerraduras en puertas blindadas o acorazadas.', 'cerrajeros-parla' ),
				),
				'tipos'      => array(
					'label' => __( 'Tipos de cerraduras que cambiamos', 'cerrajeros-parla' ),
					'hint'  => __( 'Con algunas de las marcas más conocidas.', 'cerrajeros-parla' ),
				),
				'economico'  => array(
					'label' => __( 'Cambio de cerradura económico', 'cerrajeros-parla' ),
					'hint'  => __( 'Precio, transparencia y relación calidad-precio.', 'cerrajeros-parla' ),
				),
				'cta'        => $cta,
			),
		),
		'cierres'   => array(
			'label' => __( 'Reparación de cierres metálicos y persianas', 'cerrajeros-parla' ),
			'slots' => array(
				'intro'        => array(
					'label' => __( 'Introducción', 'cerrajeros-parla' ),
					'hint'  => __( '«Reparación de cierres metálicos / arreglo de persianas metálicas en Parla».', 'cerrajeros-parla' ),
				),
				'urgente'      => array(
					'label' => __( 'Servicio urgente para locales', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: principales averías en persianas de comercios; mantenimiento preventivo.', 'cerrajeros-parla' ),
				),
				'tipos'        => array(
					'label' => __( 'Tipos de cierres metálicos', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: según la lama (ciega, microperforada, troquelada, concha, ballesta); según el material.', 'cerrajeros-parla' ),
				),
				'motorizacion' => array(
					'label' => __( 'Motorización y automatización', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: instalación de motores; reparación de motores, cuadros y mandos.', 'cerrajeros-parla' ),
				),
				'soluciones'   => array(
					'label' => __( 'Comercios, garajes y naves', 'cerrajeros-parla' ),
					'hint'  => __( 'H2 + H3: cierres enrollables para garajes; alta seguridad para escaparates y accesos.', 'cerrajeros-parla' ),
				),
				'porque'       => array(
					'label' => __( '¿Por qué elegirnos?', 'cerrajeros-parla' ),
					'hint'  => __( 'H2: ¿Por qué elegir nuestro servicio de reparación de cierres en Parla?', 'cerrajeros-parla' ),
				),
				'cta'          => $cta,
			),
		),
		'quienes'   => array(
			'label' => __( 'Quiénes somos', 'cerrajeros-parla' ),
			'slots' => array(
				'intro'       => array(
					'label' => __( 'Introducción – Quiénes somos', 'cerrajeros-parla' ),
					'hint'  => __( 'Presentación cercana: quiénes sois y desde cuándo.', 'cerrajeros-parla' ),
				),
				'historia'    => array(
					'label' => __( 'Nuestra historia', 'cerrajeros-parla' ),
					'hint'  => __( 'Origen, evolución y vínculo con Parla.', 'cerrajeros-parla' ),
				),
				'trabajo'     => array(
					'label' => __( 'Cómo trabajamos hoy', 'cerrajeros-parla' ),
					'hint'  => __( 'Equipo, formación, medios, cobertura 24 horas y servicios.', 'cerrajeros-parla' ),
				),
				'compromiso'  => array(
					'label' => __( 'Nuestro compromiso contigo', 'cerrajeros-parla' ),
					'hint'  => __( 'Transparencia en precios, trato humano, garantía del trabajo.', 'cerrajeros-parla' ),
				),
				'cta'         => array(
					'label' => __( 'CTA (llamada a la acción)', 'cerrajeros-parla' ),
					'hint'  => __( 'Invitación cercana a llamar, sin urgencia. El botón de llamada se añade solo.', 'cerrajeros-parla' ),
				),
			),
		),
	);

	return apply_filters( 'cpc_text_layouts', $layouts );
}

/**
 * Page type of a page: the one chosen in the editor, or detected from the front page / slug.
 *
 * @param int $post_id Page ID.
 * @return string Layout key, or '' for a page without text slots.
 */
function cpc_get_layout( $post_id ) {
	$layouts = cpc_text_layouts();
	$chosen  = get_post_meta( $post_id, '_cpc_layout', true );

	if ( 'none' === $chosen ) {
		return '';
	}
	if ( $chosen && isset( $layouts[ $chosen ] ) ) {
		return $chosen;
	}

	return cpc_detect_layout( $post_id );
}

/**
 * Automatic page type, from the front-page setting and the slug.
 *
 * @param int $post_id Page ID.
 * @return string Layout key or ''.
 */
function cpc_detect_layout( $post_id ) {
	if ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) === (int) $post_id ) {
		return 'home';
	}

	$slug = (string) get_post_field( 'post_name', $post_id );
	$map  = array(
		'cerrojo'       => 'cerrojos',
		'cerradura'     => 'cerradura',
		'bombin'        => 'cerradura',
		'cierre'        => 'cierres',
		'persiana'      => 'cierres',
		'quienes-somos' => 'quienes',
		'nosotros'      => 'quienes',
	);
	foreach ( $map as $needle => $layout ) {
		if ( false !== strpos( $slug, $needle ) ) {
			return $layout;
		}
	}

	return '';
}

/**
 * Formats slot HTML like post content, without running the full the_content filter
 * (so plugins that append things to the content do not repeat them in every slot).
 *
 * @param string $html Raw slot HTML.
 * @return string
 */
function cpc_format_text( $html ) {
	$html = wptexturize( $html );
	$html = convert_chars( $html );
	$html = wpautop( $html );
	$html = shortcode_unautop( $html );
	$html = do_shortcode( $html );
	if ( function_exists( 'wp_filter_content_tags' ) ) {
		$html = wp_filter_content_tags( $html ); // srcset + lazy loading for inserted images.
	}
	return $html;
}

/**
 * The filled text slots of a page, formatted.
 *
 * @param int|null $post_id Page ID.
 * @return array {
 *     @type array  $blocks Slot key => HTML for every filled slot except the CTA, in order.
 *     @type string $cta    CTA HTML ('' when empty).
 * }
 */
function cpc_get_texts( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$layout  = cpc_get_layout( $post_id );
	$result  = array(
		'blocks' => array(),
		'cta'    => '',
	);

	if ( ! $layout ) {
		return $result;
	}

	$layouts = cpc_text_layouts();
	foreach ( array_keys( $layouts[ $layout ]['slots'] ) as $slot ) {
		$raw = (string) get_post_meta( $post_id, '_cpc_text_' . $slot, true );
		if ( '' === trim( wp_strip_all_tags( $raw ) ) && false === strpos( $raw, '<img' ) ) {
			continue;
		}
		if ( 'cta' === $slot ) {
			$result['cta'] = cpc_format_text( $raw );
		} else {
			$result['blocks'][ $slot ] = cpc_format_text( $raw );
		}
	}

	return $result;
}

/**
 * Prints the CTA slot as a Forge Black card with the gold call button.
 *
 * @param string $html CTA HTML.
 */
function cpc_cta_slot( $html ) {
	if ( '' === $html ) {
		return;
	}
	?>
	<div class="cta-slot">
		<div class="cta-slot__body entry-content">
			<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- formatted slot HTML. ?>
		</div>
		<?php cpc_call_button( 'cta-slot', '', 'btn-xl' ); ?>
	</div>
	<?php
}

/**
 * Editor-only placeholder for an empty text slot (visitors never see it).
 *
 * @param string $label Slot name.
 */
function cpc_empty_slot_hint( $label ) {
	if ( ! current_user_can( 'edit_post', get_the_ID() ) ) {
		return;
	}
	printf(
		'<p class="slot-hint">%s</p>',
		/* translators: %s: text slot name. */
		esc_html( sprintf( __( 'Hueco de texto «%s» vacío: rellénalo en el editor de la página (solo lo ves tú).', 'cerrajeros-parla' ), $label ) )
	);
}

/*--------------------------------------------------------------
# Admin
--------------------------------------------------------------*/

/**
 * Prints the slot editors below the main editor (not in a meta box: TinyMCE breaks when a meta box is dragged).
 *
 * @param WP_Post $post Post being edited.
 */
function cpc_render_text_slots( $post ) {
	if ( 'page' !== $post->post_type ) {
		return;
	}

	$layouts  = cpc_text_layouts();
	$chosen   = (string) get_post_meta( $post->ID, '_cpc_layout', true );
	$detected = cpc_detect_layout( $post->ID );
	$layout   = cpc_get_layout( $post->ID );

	wp_nonce_field( 'cpc_save_texts', 'cpc_texts_nonce' );
	?>
	<div id="cpc-text-slots" class="postbox" style="margin-top:20px">
		<div class="postbox-header"><h2 class="hndle" style="padding:8px 12px"><?php esc_html_e( 'Huecos de texto de la página', 'cerrajeros-parla' ); ?></h2></div>
		<div class="inside">
			<p>
				<label for="cpc_layout"><strong><?php esc_html_e( 'Tipo de página:', 'cerrajeros-parla' ); ?></strong></label>
				<select name="cpc_layout" id="cpc_layout">
					<option value="" <?php selected( $chosen, '' ); ?>>
						<?php
						/* translators: %s: detected page type. */
						printf( esc_html__( 'Automático (%s)', 'cerrajeros-parla' ), esc_html( $detected ? $layouts[ $detected ]['label'] : __( 'sin huecos', 'cerrajeros-parla' ) ) );
						?>
					</option>
					<?php foreach ( $layouts as $key => $def ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $chosen, $key ); ?>><?php echo esc_html( $def['label'] ); ?></option>
					<?php endforeach; ?>
					<option value="none" <?php selected( $chosen, 'none' ); ?>><?php esc_html_e( 'Sin huecos (usar el editor principal)', 'cerrajeros-parla' ); ?></option>
				</select>
				<span class="description"><?php esc_html_e( 'Si cambias el tipo, guarda la página para ver sus huecos.', 'cerrajeros-parla' ); ?></span>
			</p>

			<?php if ( ! $layout ) : ?>
				<p class="description"><?php esc_html_e( 'Esta página no tiene huecos de texto: se muestra el contenido del editor principal.', 'cerrajeros-parla' ); ?></p>
			<?php else : ?>
				<p class="description"><?php esc_html_e( 'Si rellenas algún hueco, la página muestra los huecos en lugar del editor principal. Los huecos vacíos no se muestran.', 'cerrajeros-parla' ); ?></p>
				<?php
				$i = 0;
				foreach ( $layouts[ $layout ]['slots'] as $slot => $def ) :
					++$i;
					?>
					<div class="cpc-text-slot" style="margin:24px 0 8px">
						<h3 style="margin:0 0 4px"><?php echo esc_html( $i . '. ' . $def['label'] ); ?></h3>
						<p class="description" style="margin:0 0 8px"><?php echo esc_html( $def['hint'] ); ?></p>
						<?php
						wp_editor(
							(string) get_post_meta( $post->ID, '_cpc_text_' . $slot, true ),
							'cpc_text_' . $slot,
							array(
								'textarea_name' => 'cpc_texts[' . $slot . ']',
								'textarea_rows' => 12,
								'media_buttons' => true,
								'teeny'         => false,
								'wpautop'       => true,
							)
						);
						?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php
}
add_action( 'edit_form_after_editor', 'cpc_render_text_slots' );

/**
 * Saves the page type and the slot texts.
 *
 * @param int $post_id Page ID.
 */
function cpc_save_texts( $post_id ) {
	if ( ! isset( $_POST['cpc_texts_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cpc_texts_nonce'] ) ), 'cpc_save_texts' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$layouts = cpc_text_layouts();
	$chosen  = isset( $_POST['cpc_layout'] ) ? sanitize_key( wp_unslash( $_POST['cpc_layout'] ) ) : '';
	if ( 'none' === $chosen || isset( $layouts[ $chosen ] ) ) {
		update_post_meta( $post_id, '_cpc_layout', $chosen );
	} else {
		delete_post_meta( $post_id, '_cpc_layout' );
	}

	// Only the slots that were on screen are saved; texts of other page types are kept.
	$texts = isset( $_POST['cpc_texts'] ) && is_array( $_POST['cpc_texts'] ) ? wp_unslash( $_POST['cpc_texts'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitized below.
	foreach ( $texts as $slot => $html ) {
		$slot = sanitize_key( $slot );
		$html = current_user_can( 'unfiltered_html' ) ? (string) $html : wp_kses_post( (string) $html );

		if ( '' === trim( $html ) ) {
			delete_post_meta( $post_id, '_cpc_text_' . $slot );
		} else {
			update_post_meta( $post_id, '_cpc_text_' . $slot, wp_slash( $html ) );
		}
	}
}
add_action( 'save_post_page', 'cpc_save_texts' );

/*--------------------------------------------------------------
# Context copy: theme-owned texts per page type (anti-cannibalisation)
--------------------------------------------------------------*/

/**
 * Page type of the current request: a page's layout, or 'home' for everything else.
 *
 * @return string
 */
function cpc_current_context() {
	static $context = null;

	if ( null === $context ) {
		$context = 'home';
		if ( is_page() && ! is_front_page() ) {
			$layout  = cpc_get_layout( get_queried_object_id() );
			$context = $layout ? $layout : 'neutral';
		}
	}

	return $context;
}

/**
 * Theme-owned text for the current page type.
 *
 * Each service page only uses its own keyword; the home keyword
 * ("cerrajeros Parla") and the other services' keywords appear there
 * only as link text (menu, footer, service cards).
 *
 * @param string $field eyebrow|lead|badge|alt_2|fallback_h2|fallback_p|band_eyebrow|band_title|band_text|footer_text.
 * @return string Plain text (escape on output).
 */
function cpc_copy( $field ) {
	$phone = CPC_PHONE_DISPLAY;
	$any   = __( 'Llámanos a cualquier hora: atendemos por teléfono las 24 horas, todos los días.', 'cerrajeros-parla' );

	$copy = array(
		'home'      => array(
			'eyebrow'      => __( 'Cerrajeros 24 h · Parla (Madrid)', 'cerrajeros-parla' ),
			/* translators: %s: phone number. */
			'lead'         => sprintf( __( 'Servicio de cerrajería en Parla las 24 horas, todos los días. Llama al %s y cuéntanos qué necesitas.', 'cerrajeros-parla' ), $phone ),
			'badge'        => __( 'Cerrajero libre en Parla', 'cerrajeros-parla' ),
			'alt_2'        => __( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ),
			'fallback_h2'  => __( 'Cerrajeros en Parla 24 horas', 'cerrajeros-parla' ),
			'fallback_p'   => __( 'Cuéntanos por teléfono qué te ha pasado y te indicamos cómo lo resolvemos.', 'cerrajeros-parla' ),
			'band_eyebrow' => __( 'Cerrajero urgente en Parla', 'cerrajeros-parla' ),
			'band_title'   => __( '¿Te has quedado fuera de casa?', 'cerrajeros-parla' ),
			'band_text'    => $any,
			'footer_text'  => __( 'Cerrajeros urgentes en Parla (Madrid), 24 horas.', 'cerrajeros-parla' ),
		),
		'cerradura' => array(
			'eyebrow'      => __( 'Cerraduras y bombines · Parla (Madrid)', 'cerrajeros-parla' ),
			/* translators: %s: phone number. */
			'lead'         => sprintf( __( 'Cambio de cerradura y bombín en Parla las 24 horas, todos los días. Llama al %s y cuéntanos qué cerradura tienes.', 'cerrajeros-parla' ), $phone ),
			'badge'        => __( 'Técnico libre en Parla', 'cerrajeros-parla' ),
			'alt_2'        => __( 'Cambio de cerradura en Parla', 'cerrajeros-parla' ),
			'fallback_h2'  => __( 'Cambio de cerradura en Parla, 24 horas', 'cerrajeros-parla' ),
			'fallback_p'   => __( 'Cuéntanos por teléfono qué le pasa a tu cerradura o a tu bombín y te indicamos cómo lo resolvemos.', 'cerrajeros-parla' ),
			'band_eyebrow' => __( 'Cambio de cerradura urgente', 'cerrajeros-parla' ),
			'band_title'   => __( '¿Llave perdida o cerradura dañada?', 'cerrajeros-parla' ),
			'band_text'    => $any,
			'footer_text'  => __( 'Cambio de cerraduras y bombines en Parla (Madrid).', 'cerrajeros-parla' ),
		),
		'cerrojos'  => array(
			'eyebrow'      => __( 'Cerrojos de seguridad · Parla (Madrid)', 'cerrajeros-parla' ),
			/* translators: %s: phone number. */
			'lead'         => sprintf( __( 'Instalación de cerrojos de seguridad en Parla las 24 horas, todos los días. Llama al %s y cuéntanos qué puerta quieres reforzar.', 'cerrajeros-parla' ), $phone ),
			'badge'        => __( 'Técnico libre en Parla', 'cerrajeros-parla' ),
			'alt_2'        => __( 'Instalación de cerrojos de seguridad en Parla', 'cerrajeros-parla' ),
			'fallback_h2'  => __( 'Instalación de cerrojos de seguridad en Parla', 'cerrajeros-parla' ),
			'fallback_p'   => __( 'Cuéntanos por teléfono qué puerta tienes y te indicamos qué cerrojo de seguridad encaja.', 'cerrajeros-parla' ),
			'band_eyebrow' => __( 'Instalación de cerrojos', 'cerrajeros-parla' ),
			'band_title'   => __( '¿Quieres reforzar tu puerta?', 'cerrajeros-parla' ),
			'band_text'    => $any,
			'footer_text'  => __( 'Instalación de cerrojos de seguridad en Parla (Madrid).', 'cerrajeros-parla' ),
		),
		'cierres'   => array(
			'eyebrow'      => __( 'Cierres metálicos · Parla (Madrid)', 'cerrajeros-parla' ),
			/* translators: %s: phone number. */
			'lead'         => sprintf( __( 'Reparación de cierres metálicos y persianas de comercio en Parla las 24 horas, todos los días. Llama al %s y cuéntanos qué le pasa.', 'cerrajeros-parla' ), $phone ),
			'badge'        => __( 'Técnico libre en Parla', 'cerrajeros-parla' ),
			'alt_2'        => __( 'Reparación de cierres metálicos en Parla', 'cerrajeros-parla' ),
			'fallback_h2'  => __( 'Reparación de cierres metálicos en Parla', 'cerrajeros-parla' ),
			'fallback_p'   => __( 'Cuéntanos por teléfono qué le pasa a tu persiana metálica y te indicamos cómo lo resolvemos.', 'cerrajeros-parla' ),
			'band_eyebrow' => __( 'Reparación urgente de cierres', 'cerrajeros-parla' ),
			'band_title'   => __( '¿Tu persiana metálica no sube o no baja?', 'cerrajeros-parla' ),
			'band_text'    => $any,
			'footer_text'  => __( 'Reparación de cierres metálicos y persianas de comercio en Parla (Madrid).', 'cerrajeros-parla' ),
		),
		'quienes'   => array(
			'eyebrow'      => __( 'Quiénes somos · Parla (Madrid)', 'cerrajeros-parla' ),
			/* translators: %s: phone number. */
			'lead'         => sprintf( __( 'Te contamos quiénes somos. Si nos necesitas, llama al %s a cualquier hora.', 'cerrajeros-parla' ), $phone ),
			'badge'        => __( 'Técnico libre en Parla', 'cerrajeros-parla' ),
			'alt_2'        => CPC_BRAND,
			'fallback_h2'  => CPC_BRAND,
			'fallback_p'   => __( 'Llámanos y cuéntanos en qué te podemos ayudar.', 'cerrajeros-parla' ),
			'band_eyebrow' => CPC_BRAND,
			'band_title'   => __( '¿Hablamos?', 'cerrajeros-parla' ),
			'band_text'    => $any,
			'footer_text'  => __( 'Parla Cerrajeros CP, en Parla (Madrid).', 'cerrajeros-parla' ),
		),
	);

	// Legal pages and other pages without a type: no service keyword at all.
	$copy['neutral']                 = $copy['quienes'];
	$copy['neutral']['eyebrow']      = __( 'Parla (Madrid)', 'cerrajeros-parla' );
	$copy['neutral']['lead']         = '';
	$copy['neutral']['band_title']   = __( '¿Necesitas ayuda?', 'cerrajeros-parla' );

	$copy    = apply_filters( 'cpc_context_copy', $copy );
	$context = cpc_current_context();
	$set     = isset( $copy[ $context ] ) ? $copy[ $context ] : $copy['home'];

	return isset( $set[ $field ] ) ? $set[ $field ] : '';
}
