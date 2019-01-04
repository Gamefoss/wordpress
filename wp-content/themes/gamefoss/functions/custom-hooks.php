<?php
	// ADD LUDOKRATIA POSTS TO AUTHOR PAGE
	add_action( 'pre_get_posts', function ( $query ) {
		if ( !is_admin() && $query->is_author() && $query->is_main_query() ) $query->set( 'post_type', array('post', 'ludokratia' ) );
	} );
?>
