<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION
	
add_theme_support( 'post-formats', array( 'aside', 'gallery','standard','status','link','image','video','quote','audio','chat') );

add_filter( 'jetpack_honor_dnt_header_for_stats', '__return_true' );

if ( !function_exists('indieweb_check_webmention') ) {

	/**
	 * Using the webmention_source_url, approve webmentions that have been received from previously-
	 * approved domains. For example, once you approve a webmention from http://example.com/post,
	 * future webmentions from http://example.com will be automatically approved.
	 * Recommend placing in your theme's functions.php
	 *
	 * Based on check_comment()
	 * @see https://core.trac.wordpress.org/browser/tags/4.9/src/wp-includes/comment.php#L113
	 */
	function indieweb_check_webmention($approved, $commentdata) {
		global $wpdb;

		if ( 1 == get_option('comment_whitelist')) {

			if ( !empty($commentdata['comment_meta']['webmention_source_url']) ) {
				$like_domain = sprintf('%s://%s%%', parse_url($commentdata['comment_meta']['webmention_source_url'], PHP_URL_SCHEME), parse_url($commentdata['comment_meta']['webmention_source_url'], PHP_URL_HOST));

				$ok_to_comment = $wpdb->get_var( $wpdb->prepare( "SELECT comment_approved FROM $wpdb->comments WHERE comment_author = %s AND comment_author_url LIKE %s AND comment_approved = '1' LIMIT 1", $commentdata['comment_author'], $like_domain ) );

				if ( 1 == $ok_to_comment ) {
					return 1;
				}

			}

		}

		return $approved;
	}

	add_filter('pre_comment_approved', 'indieweb_check_webmention', '99', 2);
}

//Remove Post Title in Blog for Status Posts

add_filter( 'post_class', 'crt_remove_status_post_titles' );
function crt_remove_status_post_titles( $classes ) {
	if ( has_post_format( 'status' ) ) {
		$classes[] = 'hidetitle';
	}
	return $classes;
}


//Remove Post Title in RSS for Status Posts

add_filter( 'the_title_rss', 'crt_change_feed_post_title' );
function crt_crt_change_feed_post_title( $title ) {
	if ( has_post_format( 'status' ) ) {
		$title = '';
	}
	return $title;
}


// Remove Status Posts from the Main Blog

//* Remove status post format from main query unless page is the status archive or an admin screen

/*

add_filter( 'pre_get_posts', 'crt_remove_status_format' );
function crt_remove_status_format( $query ) {

	if ( ! is_tax( 'post_format', 'post-format-status' ) && ! is_search() && ! is_admin() && ! ( defined ( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) ) {

		$tax_query = array( array(

			'taxonomy' 	=> 'post_format',
			'field'		=> 'slug',
			'terms'		=> 'post-format-status',
			'operator'	=> 'NOT IN',

		) );

		$query->set( 'tax_query', $tax_query );

	}

}
*/

// Change the Post Title to the Current Date
add_filter( 'wp_insert_post_data', 'crt_update_blank_title' );
function crt_update_blank_title( $data ) {
	$title = $data['post_title'];
	$post_type = $data['post_type'];
	
	if ( empty( $title ) && ( $post_type == 'post' ) ) {
		$timezone = get_option('timezone_string');
		date_default_timezone_set( $timezone );
		$title = date( 'Y-m-d H.i.s' );
		$data['post_title'] = $title;
	}
	return $data;
}

//* Do not trigger Jetpack Publicize if the post uses the 'status' post format.

add_filter( 'publicize_should_publicize_published_post', 'crt_control_publicize', 10, 2 );
function crt_control_publicize( $should_publicize, $post ) {

	// Return early if we don't have a post yet (it hasn't been saved as a draft)
	if ( ! $post ) {

		return $should_publicize;

	}

	// Return false if the format is 'status'
	if ( has_post_format( 'status', $post->ID ) ) {

		return false;

	}

	return $should_publicize;

}

function sempress_setup() {
		global $themecolors;

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on sempress, use a find and replace
		 * to change 'sempress' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'sempress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 ); // Unlimited height, soft crop

		// Register custom image size for image post formats.
		add_image_size( 'sempress-image-post', 668, 1288 );

		// Switches default core markup for search form to output valid HTML5.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'sempress' ),
		) );

		// Add support for the Aside, Gallery Post Formats...
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'status', 'image', 'video', 'audio', 'quote' ) );

		/**
		 * This theme supports jetpacks "infinite-scroll"
		 *
		 * @see http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support( 'infinite-scroll', array( 'container' => 'content', 'footer' => 'colophon' ) );

		/**
		 * This theme supports the "title-tag" feature
		 *
		 * @see https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Draw attention to supported WebSemantics
		 */
		add_theme_support( 'microformats2' );
		add_theme_support( 'microformats' );
		add_theme_support( 'microdata' );

		if ( get_theme_mod( 'sempress_columns', 'multi' ) === 'single' ) {
			$width = 960;
		} else {
			$width = 1200;
		}

		// This theme supports a custom header
		$custom_header_args = array(
			'width'		 => $width,
			'height'		=> 200,
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $custom_header_args );

		// custom logo support
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
		) );

		// This theme supports custom backgrounds
		$custom_background_args = array(
			'default-color' => $themecolors['bg'],
			'default-image' => get_template_directory_uri() . '/img/noise.png',
		);
		add_theme_support( 'custom-background', $custom_background_args );

		// Nicer WYSIWYG editor
		add_editor_style( 'css/editor-style.css' );

		add_filter( 'use_default_gallery_style', '__return_false' );
	}

add_action( 'after_setup_theme', 'sempress_seup' );


// Set JPG image quality to 100%
add_filter('jpeg_quality', function($arg){return 100;});
add_filter( 'wp_editor_set_quality', function($arg){return 100;} );


// Twitter Cards
function tweakjp_custom_twitter_site( $og_tags ) {
    $og_tags['twitter:site'] = '@khurtwilliams';
    // $og_tags['twitter:card'] = 'summary';
    return $og_tags;
}
add_filter( 'jetpack_open_graph_tags', 'tweakjp_custom_twitter_site', 11 );