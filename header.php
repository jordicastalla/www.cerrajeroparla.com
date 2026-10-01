<?php
/**
 * Site header: Forge Black bar, typographic logo, live status badge and call trigger.
 *
 * @package Cerrajeros_Parla
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#111827">
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>

	<!-- Google Fonts: Outfit & DM Sans (stylesheet enqueued in functions.php) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>

	<!-- Schema.org LocalBusiness / Locksmith -->
	<script type="application/ld+json"><?php echo wp_json_encode( cpc_schema_data(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG ); ?></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Saltar al contenido', 'cerrajeros-parla' ); ?></a>

<header id="masthead" class="site-header">
	<div class="topbar">
		<div class="topbar__inner">
			<p class="status-badge">
				<span class="status-dot" aria-hidden="true"></span>
				<?php esc_html_e( 'Cerrajero libre en Parla', 'cerrajeros-parla' ); ?>
			</p>
			<p class="topbar__meta">
				<?php echo cpc_icon( 'clock' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
				<?php esc_html_e( 'Servicio 24 h · Parla y Madrid Sur', 'cerrajeros-parla' ); ?>
			</p>
		</div>
	</div>

	<div class="site-header__bar">
		<div class="site-branding">
			<?php cpc_site_logo( 'header' ); ?>
		</div>

		<nav id="site-navigation" class="main-nav" aria-label="<?php esc_attr_e( 'Menú principal', 'cerrajeros-parla' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main-menu',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu',
					'depth'          => 2,
					'fallback_cb'    => 'cpc_menu_fallback',
				)
			);
			?>
		</nav>

		<div class="site-header__actions">
			<?php /* translators: %s: phone number. */ ?>
			<a class="btn-gold header-call" href="<?php echo esc_url( cpc_phone_href() ); ?>" data-call="header" aria-label="<?php echo esc_attr( sprintf( __( 'Llamar al %s, urgencias 24 horas', 'cerrajeros-parla' ), CPC_PHONE_DISPLAY ) ); ?>">
				<?php echo cpc_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
				<span class="header-call__text">
					<span class="header-call__label"><?php esc_html_e( 'Urgencias 24 h', 'cerrajeros-parla' ); ?></span>
					<span class="header-call__number"><?php echo esc_html( CPC_PHONE_DISPLAY ); ?></span>
				</span>
			</a>

			<button class="nav-toggle" type="button" aria-controls="site-navigation" aria-expanded="false">
				<?php echo cpc_icon( 'menu', 'nav-toggle__open' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
				<?php echo cpc_icon( 'close', 'nav-toggle__close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Menú', 'cerrajeros-parla' ); ?></span>
			</button>
		</div>
	</div>
</header>
