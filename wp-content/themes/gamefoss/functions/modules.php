<?php
// AD HANDLER
function ad( $size = 'square' ) {
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
