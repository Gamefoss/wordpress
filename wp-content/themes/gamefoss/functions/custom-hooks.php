<?php
	// ADD LUDOKRATIA POSTS TO AUTHOR PAGE
	add_action( 'pre_get_posts', function ( $query ) {
		if ( !is_admin() && $query->is_author() && $query->is_main_query() ) $query->set( 'post_type', array('post', 'ludokratia' ) );
	} );

	// deferred styles & scripts
	function deferred_scripts($tag, $handle) {

		$_async = array(
			"wp-embed"
		);
		if ( in_array( $handle, $_async ) ) return str_replace( ' src', ' async src', $tag );

		$_defer = array();
		if ( in_array( $handle, $_defer ) ) return str_replace( ' src', ' defer src', $tag );

		if ( strpos ( $handle, "async-" ) === 0 ) return str_replace( ' src', ' async src', $tag );

		if ( strpos ( $handle, "defer-" ) === 0 ) return str_replace( ' src', ' defer src', $tag );

		return $tag;
	}
	add_filter('script_loader_tag', 'deferred_scripts', 10, 2);
?>
