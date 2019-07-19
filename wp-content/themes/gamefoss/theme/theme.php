<?php

/**************************************
CLEANUP
**************************************/
// remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');

// Remove jquery migrate
add_action( 'wp_default_scripts', function ( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		if ( $scripts->registered['jquery']->deps ) $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
	}
} );

// remove guntemberg styles
add_action( 'wp_print_styles', function () {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'qts_front_styles' );
}, 100 );


/**************************************
THEME SETUP
**************************************/
// SUPPORT
if ( function_exists( 'add_theme_support' ) ) {

	add_theme_support('menus'); // Add Menu Support

	add_theme_support('post-thumbnails'); // Add Thumbnail Theme Support

	// add_theme_support('automatic-feed-links'); // Enables post and comment RSS feed links to head

	// ADD MENUS
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'theme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'theme' ) // secondary nav in footer
		)
	);
}

// STYLES & SCRIPTS
add_action( 'wp_enqueue_scripts', function () {
	if (!is_admin()) {
		// Add base css
		wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . "/library/css/style.css", array(), null);

		// Add base js
		wp_enqueue_script( 'defer-script-js', get_template_directory_uri() . "/library/js/scripts.min.js", array( 'jquery' ), null, true );
		wp_enqueue_script( 'defer-layout-js', get_stylesheet_directory_uri() . "/library/js/layout/layout.min.js", array( 'jquery' ), null, true );

		// add ajaxurl for REST API
		wp_localize_script( 'jquery', 'ajax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		));
	}
});

// ACF OPTIONS PAGE
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(
		array(
			'page_title'  => "Social",
			'icon_url'    => "dashicons-share"
		)
	);
	acf_add_options_page(
		array(
			'page_title'  => "Analytics",
			'icon_url'    => "dashicons-analytics"
		)
	);
	acf_add_options_page(
		array(
			'page_title'  => "Footer",
			'icon_url'    => "dashicons-menu"
		)
	);
	acf_add_options_page(
		array(
			'page_title'  => "Páginas de erro",
			'icon_url'    => "dashicons-warning"
		)
	);
	acf_add_options_page(
		array(
			'page_title'  => "Anúncios",
			'icon_url'    => "dashicons-cart"
		)
	);
}

/**************************************
REMOVE COMMENTS
**************************************/
// Disable support for comments and trackbacks in post types
add_action('admin_init', function () {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
add_filter('comments_array', function ($comments) {
	$comments = array();
	return $comments;
}, 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});

// Redirect any user trying to access comments page
add_action('admin_init', function () {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
});

// Remove comments metabox from dashboard
add_action('admin_init', function () {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
});

// Remove comments links from admin bar
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});

// Customizer
require_once("customizer.php");
?>
