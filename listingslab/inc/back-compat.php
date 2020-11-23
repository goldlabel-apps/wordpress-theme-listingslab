<?php
/**
 * Listingslab back compat functionality
 *
 * Prevents Listingslab from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 */

/**
 * Prevent switching to Listingslab on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Listingslab Theme 1.0
 */
function listingslab_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'listingslab_upgrade_notice' );
}
add_action( 'after_switch_theme', 'listingslab_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Listingslab on WordPress versions prior to 4.7.
 *
 * @since Listingslab Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function listingslab_upgrade_notice() {
	/* translators: %s: The current WordPress version. */
	$message = sprintf( __( 'Listingslab requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'listingslab' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Listingslab Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function listingslab_customize() {
	wp_die(
		/* translators: %s: The current WordPress version. */
		sprintf( __( 'Listingslab requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'listingslab' ), $GLOBALS['wp_version'] ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'listingslab_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Listingslab Theme 1.0
 *
 * @global string $wp_version WordPress version.
 */
function listingslab_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: The current WordPress version. */
		wp_die( sprintf( __( 'Listingslab requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'listingslab' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'listingslab_preview' );
