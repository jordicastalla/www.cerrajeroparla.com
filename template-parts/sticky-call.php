<?php
/**
 * Mobile-only fixed call bar in Avutarda Gold.
 *
 * @package Cerrajeros_Parla
 */

?>
<?php /* translators: %s: phone number. */ ?>
<a class="sticky-call" href="<?php echo esc_url( cpc_phone_href() ); ?>" data-call="sticky" aria-label="<?php echo esc_attr( sprintf( __( 'Llamar al %s', 'cerrajeros-parla' ), CPC_PHONE_DISPLAY ) ); ?>">
	<?php echo cpc_icon( 'bolt', 'sticky-call__bolt' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?>
	<span class="sticky-call__text">
		<?php
		/* translators: %s: phone number. */
		echo esc_html( sprintf( __( 'LLAMAR: %s', 'cerrajeros-parla' ), CPC_PHONE_DISPLAY ) );
		?>
	</span>
</a>
