<?php
/**
 * Custom widget implementation
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Listingslab_Theme
 * @since Listingslab Theme 1.0
 */

class Listingslab_Widget extends WP_Widget {
 
    function __construct() {
        parent::__construct( false, __( 'Listingslab Theme', 'listingslab_theme' ) );
    }
 
    function widget( $args, $instance ) {
        $html = file_get_contents(get_template_directory_uri() . '/app/build/index.html');
        $html = str_replace('href="/static', 'href="'. get_template_directory_uri() .
            '/app/build/static', $html);
        $html = str_replace('src="/static', 'src="'. get_template_directory_uri() .
            '/app/build/static', $html);
        // echo ;
        echo $html;
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
 
    function form( $instance ) {
        echo '<p><b>TODO</b>: Set colours & text</p>';
    }
}
 
function listingslab_register_widget() {
    register_widget( 'Listingslab_Widget' );
}

add_action( 'widgets_init', 'listingslab_register_widget' ); 
