<?php
// AD HANDLER
function ad( $size = "auto" ) {

	// verify custom ads condition
	global $_custom_ads;
	$_custom_ads = ($_custom_ads)? $_custom_ads : array(); // get the custom ads

	// if none, run once per page view to fetch them
	if ( !sizeof($_custom_ads) && get_field('custom_ads', 'option') ) {
		// get only valid ads
		if ( have_rows('custom_ads', 'option') ) {
			while ( have_rows('custom_ads', 'option') ) {
				the_row();

				// verify pages
				if ( is_array( get_sub_field('show_pages') ) ) {
					if( !in_array( get_the_ID(), get_sub_field( 'show_pages' ) ) ) continue;
				}

				// verify impressions
				if ( get_sub_field( 'max_impressions' ) ) {
					if ( intval( get_sub_field( 'impressions' )) > intval( get_sub_field( 'max_impressions' ) ) ) continue;
				}

				// verify clicks
				if ( get_sub_field( 'max_clicks' ) ) {
					if ( intval( get_sub_field( 'clicks' )) > intval( get_sub_field( 'max_clicks' ) ) ) continue;
				}

				// verify max ad date
				if ( get_sub_field( 'max_date' ) ) {
					if ( date('d/m/Y') > get_sub_field( 'max_date' ) ) continue;
				}

				// after all verifications, add to custom ad list
				array_push( $_custom_ads, (object) array(
					'name'	=> get_sub_field( 'name' ),
					'code'	=> get_sub_field( 'code' ),
					'size'	=> get_sub_field( 'size' )
				) );
			}
		}
	}

	$_ad = false; // by default, there is no ad

	// if there is valid custom ads, they will appear only 50% of the time
	if ( sizeof( $_custom_ads ) && rand( 0, 1 ) ) {

		// filter by valid custom ad sizes
		$_valid_custom_ads = array();
		foreach( $_custom_ads as $_custom_ad ) if ( $_custom_ad->size == $size ) array_push( $_valid_custom_ads, $_custom_ad );

		// if any custom ad fits
		if ( sizeof($_valid_custom_ads) ) {
			// get one randomly
			$_custom_ad = $_valid_custom_ads[ array_rand( $_valid_custom_ads ) ];

			// configure ad
			$_ad = (object) array(
				'name'		=> $_custom_ad->name,
				'size'		=> $size,
				'custom'	=> true,
				'code'		=> $_custom_ad->code
			);
		} else {
			// fallback to google ad
			$_ad = false;
		}
	}

	// if not custom ad and google ad configured
	if ( !$_ad && get_field('google-adsense', 'options') ) {

		$_ad = (object) array(
			'custom'	=> false,
			'size'		=> $size,
			'width'		=> "auto",
			'height'	=> "auto"
		);
		switch ($size) {
			case 'square':
				$_ad->slot = "4412129364";
				$_ad->width = "200px";
				$_ad->height = "200px";
				break;
			case 'square2':
				$_ad->slot = "1663387536";
				$_ad->width = "250px";
				$_ad->height = "250px";
				break;
			case 'mobile-banner':
				$_ad->slot = "1534684580";
				$_ad->width = "320px";
				$_ad->height = "100px";
				break;
			case 'leaderboard':
				$_ad->slot = "4627751783";
				$_ad->width = "728px";
				$_ad->height = "90px";
				break;
			case 'large-leaderboard':
				$_ad->slot = "9656717182";
				$_ad->width = "970px";
				$_ad->height = "90px";
				break;
			case 'half-page':
				$_ad->slot = "3913258308";
				$_ad->width = "300px";
				$_ad->height = "600px";
				break;
			default:
				$_ad->slot = "7093955413";
				break;
		}
	}

	include(locate_template('modules/ad.php'));
}

function ajax_ad_impression() {
	// variables
	$name = $_POST['name'];

	if ( get_field('custom_ads', 'option') ) {
		while ( have_rows('custom_ads', 'option') ) {
			the_row();
			// if ( !get_sub_field( 'max_impressions' ) ) continue;
			if ( get_sub_field( 'name' ) != $name ) continue;
			update_sub_field( 'impressions', intval( get_sub_field( 'impressions' ) ) + 1 );
			echo get_sub_field( 'impressions' );
			exit;
		}
	} else {
		echo false;
		exit;
	}
	exit;
}
add_action('wp_ajax_ajax_ad_impression', 'ajax_ad_impression');
add_action('wp_ajax_nopriv_ajax_ad_impression', 'ajax_ad_impression');

function ajax_ad_click() {
	// variables
	$name = $_POST['name'];

	if ( get_field('custom_ads', 'option') ) {
		while ( have_rows('custom_ads', 'option') ) {
			the_row();
			// if ( !get_sub_field( 'max_clicks' ) ) continue;
			if ( get_sub_field( 'name' ) != $name ) continue;
			update_sub_field( 'clicks', intval( get_sub_field( 'clicks' ) ) + 1 );
			echo get_sub_field( 'clicks' );
			exit;
		}
	} else {
		echo false;
		exit;
	}
	exit;
}
add_action('wp_ajax_ajax_ad_click', 'ajax_ad_click');
add_action('wp_ajax_nopriv_ajax_ad_click', 'ajax_ad_click');

// POST BLOCK HANDLER
function post_block( $_options = NULL ) {
	$options = array(
		'variation' 	=> isset($_options['variation'])? $_options['variation'] : ( get_field( "is_highlight" )? "highlight" :  "vertical"),
		'author'    	=> isset($_options['author'])? $_options['author'] : true ,
		'category'  	=> isset($_options['category'])? $_options['category'] : true ,
		'class'    		=> isset($_options['class'])? $_options['class'] : array(),
		'image_size'	=> isset($_options['image_size'])? $_options['image_size'] : "medium"
	);
	include(locate_template('modules/post-block.php'));
}

?>
