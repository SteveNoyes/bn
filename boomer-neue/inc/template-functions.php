<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WP_Bootstrap_4
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wp_bootstrap_4_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wp_bootstrap_4_pingback_header' );



/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'wp_bootstrap_4_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'wp_bootstrap_4_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'wp_bootstrap_4_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'wp_bootstrap_4_comments_link_attributes' );

function wp_bootstrap_4_posts_link_attributes() {
    return 'class="btn btn-outline-primary mb-4"';
}

function wp_bootstrap_4_comments_link_attributes() {
    return 'class="btn btn-outline-primary mb-4"';
}



/**
* Return shorter excerpt
*/
function wp_bootstrap_4_get_short_excerpt( $length = 40, $post_obj = null ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}
	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}
	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}
	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );
	return $trimmed_content;
}
