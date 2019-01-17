<?php

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

// REWRITE RULES FOR PAGINATION
add_filter('init', function () {
	
	add_rewrite_rule(
		'entretenimento/page/([0-9]+)?$',
		'index.php?post_type=post&paged=$matches[1]',
		'top'
	);
	add_rewrite_rule(
		'entretainment/page/([0-9]+)?$',
		'index.php?post_type=post&paged=$matches[1]',
		'top'
	);
	
}, 999 );

// STYLES & SCRIPTS
add_action( 'after_setup_theme', function() {
	// Enqueue base styles and scripts
	add_action( 'wp_enqueue_scripts', function () {
		if (!is_admin()) {
			// Add base css
			wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . "/library/css/style.css", array(), null );
			
			// Add base js
			wp_enqueue_script( 'defer-script-js', get_template_directory_uri() . "/library/js/scripts.min.js", array( 'jquery' ), null );
			wp_enqueue_script( 'defer-layout-js', get_stylesheet_directory_uri() . "/library/js/layout/layout.min.js", array( 'jquery' ), null );
			wp_enqueue_script( 'async-analytics-js', get_stylesheet_directory_uri() . "/library/js/modules/analytics.min.js", array( 'jquery' ), null );

			// add ajaxurl for REST API
			wp_localize_script( 'defer-scripts-js', 'ajax', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' )
			));			
		}
	});
} );

// remove guntemberg styles
add_action( 'wp_print_styles', function () {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'qts_front_styles' );
}, 100 );

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
