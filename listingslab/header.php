<?php
/**
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 * @version 1.0
 */

 
 $site = get_bloginfo( 'name' );
 $tagline = get_bloginfo( 'description' );
 $title = get_bloginfo( 'name' ) . ' ' . get_the_title();
 $description = strip_tags(get_the_excerpt());
 $image = get_template_directory_uri() . '/app/build/png/open-graph.png';
 if( has_post_thumbnail() ) {
 	$image = get_the_post_thumbnail_url( get_queried_object_id() );
 }

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="manifest" href="<?php echo get_template_directory_uri() 
	. '/app/build/manifest.json'; ?>" />
	<meta name="theme-color" content="#18a2ad" />
	<link rel="apple-touch-icon"
	  href="<?php echo get_template_directory_uri() 
		. '/app/build/png/apple-touch/apple-touch-icon-180x180.png'; ?>"
	/>
	<meta name="description" content="<?php echo $description;?>"/>
	<meta property="og:site_name" content="<?php echo $site;?>" />
	<meta property="og:description" content="<?php echo $description;?>" />
	<meta property="og:locale" content="<?php language_attributes(); ?>" />
	<meta property="og:title" content="<?php echo $title;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo $image; ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:alt" content="<?php echo $title;?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:description" content="<?php echo $description;?>" />
	<meta name="twitter:title" content="<?php echo $title;?>" />
	<meta name="twitter:image" content="<?php echo $image; ?>" />
	<meta name="twitter:image:alt" content="<?php echo $title;?>" />
	<meta name="mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="application-name" content="<?php echo $site;?>" />
	<meta name="apple-mobile-web-app-title" content="<?php echo $site;?>" />
	<meta name="apple-mobile-web-app-status-bar-style" content="default" />
	<script>
		window.themeOptions = {
			primary: `#333`,
			secondary: `#CCC`
		}
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php wp_body_open(); ?>

<div id="page" class="site">
	
	<a class="skip-link screen-reader-text" href="#content">
		<?php _e( 'Skip to content', 'listingslab' ); ?>
	</a>
	
	<header id="masthead" class="site-header" role="banner">
		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</header>
	
	<?php
		if ( ( is_single() 
				|| ( is_page() && ! listingslab_is_frontpage() ) ) 
				&& has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">';
				echo get_the_post_thumbnail( 
					get_queried_object_id(), 
					'listingslab-featured-image' 
				);
				echo '</div>';
		endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
