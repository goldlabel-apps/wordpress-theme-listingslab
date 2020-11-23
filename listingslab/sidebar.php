<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'listingslab' ); ?>">

		<div class="pwa-button">
			<?php if ( is_active_sidebar( 'listingslab-widget' ) ) {
					dynamic_sidebar( 'listingslab-widget' );
			} ?>
		</div>

		<div style="margin: 16px;">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>

</aside><!-- #secondary -->
