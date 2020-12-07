<?php
/**
 * Listingslab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 */

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function listingslab_admin() {
    $html = file_get_contents(get_template_directory_uri() . '/react/back/build/index.html');
    $html = str_replace('href="/static', 'href="'. get_template_directory_uri() .
        '/react/back/build/static', $html);
    $html = str_replace('src="/static', 'src="'. get_template_directory_uri() .
        '/react/back/build/static', $html);
    echo $html;
}

function listingslab_setup() {

	require get_template_directory() . '/inc/widget.php';

	load_theme_textdomain( 'listingslab' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'listingslab-featured-image', 2000, 1200, true );
	add_image_size( 'listingslab-thumbnail-avatar', 100, 100, true );
	$GLOBALS['content_width'] = 525;

	add_action('admin_menu', 'listingslab_setup_adminmenu');
	function listingslab_setup_adminmenu(){
	    add_menu_page( 
	    	'listingslab Page', 
	    	'listingslab', 
	    	'manage_options', 
	    	'listingslab', 
	    	'listingslab_admin',
	        get_template_directory_uri(__FILE__) . '/assets/svg/listingslab.svg',
	        4
	    );
	}

	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'listingslab' ),
			'social' => __( 'Social Links Menu', 'listingslab' ),

		)
	);

	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );
	add_editor_style( array( 'assets/css/editor-style.css', listingslab_fonts_url() ) );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	$starter_content = array(
		'widgets'     => array(
			
			'listingslab' => array(
				'Listingslab_Widget',
			),

			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			'sidebar-2' => array(
				'text_business_info',
			),

			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'listingslab' ),
				'file'       => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'listingslab' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'listingslab' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'listingslab' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'listingslab' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	$starter_content = apply_filters( 'listingslab_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'listingslab_setup' );

function listingslab_content_width() {

	$content_width = $GLOBALS['content_width'];
	$page_layout = get_theme_mod( 'page_layout' );
	if ( 'one-column' === $page_layout ) {
		if ( listingslab_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}
	$GLOBALS['content_width'] = apply_filters( 'listingslab_content_width', $content_width );
}
add_action( 'template_redirect', 'listingslab_content_width', 0 );


function listingslab_fonts_url() {
	$fonts_url = '';
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'listingslab' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


function listingslab_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'listingslab-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'listingslab_resource_hints', 10, 2 );

function listingslab_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Listingslab Calls To Action', 'listingslab' ),
			'id'            => 'listingslab-widget',
			'description'   => __( 'Do it, do it', 'listingslab' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'listingslab' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'listingslab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'listingslab' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'listingslab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'listingslab' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'listingslab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'listingslab_widgets_init' );


function listingslab_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'listingslab' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'listingslab_excerpt_more' );


function listingslab_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'listingslab_javascript_detection', 0 );

function listingslab_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'listingslab_pingback_header' );

function listingslab_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo listingslab_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'listingslab_colors_css_wrap' );

function listingslab_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'listingslab-fonts', listingslab_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'listingslab-style', get_stylesheet_uri(), array(), '20190507' );

	// Theme block stylesheet.
	wp_enqueue_style( 'listingslab-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'listingslab-style' ), '20190105' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'listingslab-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'listingslab-style' ), '20190408' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'listingslab-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'listingslab-style' ), '20161202' );
		wp_style_add_data( 'listingslab-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'listingslab-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'listingslab-style' ), '20161202' );
	wp_style_add_data( 'listingslab-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '20161020' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'listingslab-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '20161114', true );

	$listingslab_l10n = array(
		'quote' => listingslab_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'listingslab-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '20161203', true );
		$listingslab_l10n['expand']   = __( 'Expand child menu', 'listingslab' );
		$listingslab_l10n['collapse'] = __( 'Collapse child menu', 'listingslab' );
		$listingslab_l10n['icon']     = listingslab_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script( 'listingslab-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '20190121', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'listingslab-skip-link-focus-fix', 'listingslabScreenReaderText', $listingslab_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'listingslab_scripts' );

function listingslab_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'listingslab-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20190328' );
	// Add custom fonts.
	wp_enqueue_style( 'listingslab-fonts', listingslab_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'listingslab_block_editor_styles' );

function listingslab_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'listingslab_content_image_sizes_attr', 10, 2 );


function listingslab_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'listingslab_header_image_tag', 10, 3 );


function listingslab_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'listingslab_post_thumbnail_sizes_attr', 10, 3 );


function listingslab_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'listingslab_front_page_template' );


function listingslab_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'listingslab_widget_tag_cloud_args' );

function listingslab_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/icon-functions.php' );
