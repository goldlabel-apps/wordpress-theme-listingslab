<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 * @version 1.2
 */

?>

		</div>

		<footer id="colophon" class="site-footerXXX" role="contentinfo">
			<div class="wrap">
				<?php
					get_template_part( 'template-parts/footer/footer', 'widgets' );
					if ( has_nav_menu( 'social' ) ) :
						?>
						<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'listingslab' ); ?>">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>' . listingslab_get_svg( array( 'icon' => 'chain' ) ),
									)
								);
							?>
						</nav>
						<?php
					endif;

					get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div>
		</footer>

	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
