<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- .entry-header -->
	<div class="entry-content">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php
			the_content();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'listingslab' ),
					'after'  => '</div>',
				)
			);
		?>
		<?php listingslab_edit_link( get_the_ID() ); ?>
	</div><!-- .entry-content -->

	<header class="entry-header">
		
		<div class="pwa-button">
			<?php if ( is_active_sidebar( 'listingslab-widget' ) ) {
					dynamic_sidebar( 'listingslab-widget' );
			} ?>
		</div>
		<div style="margin: 16px;">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>

	</header>

	
</article><!-- #post-<?php the_ID(); ?> -->
