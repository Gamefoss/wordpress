<?php
// AD HANDLER
function ad( $size = "auto", $custom = false ) {
	if (!$custom) {
		// if google ad
		$_ad = (object) array(
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

// POST BLOCK HANDLER
function post_block( $_options = NULL ) {
	$options = array(
		'variation' => isset($_options['variation'])? $_options['variation'] : ( get_field( "is_highlight" )? "highlight" :  "vertical"),
		'author'    => isset($_options['author'])? $_options['author'] : true ,
		'category'  => isset($_options['category'])? $_options['category'] : true ,
		'class'    	=> isset($_options['class'])? $_options['class'] : array()
	);
	include(locate_template('modules/post-block.php'));
}

?>
