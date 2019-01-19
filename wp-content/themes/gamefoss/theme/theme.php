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
		wp_enqueue_script( 'async-analytics-js', get_stylesheet_directory_uri() . "/library/js/modules/analytics.min.js", array( 'jquery' ), null, true );

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
?>
