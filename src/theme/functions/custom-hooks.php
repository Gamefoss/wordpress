<?php
	// ADD LUDOKRATIA POSTS TO AUTHOR PAGE
	add_action( 'pre_get_posts', function ( $query ) {
		if ( !is_admin() && $query->is_author() && $query->is_main_query() ) $query->set( 'post_type', array('post', 'ludokratia' ) );
	} );

	// deferred style
	add_filter( 'style_loader_tag', function ( $tag, $handle ) {
		if ( strpos ( $handle, "inline-" ) === 0 ) {
			if ( !preg_match('/^<link.*?href=(["\'])(.*?)\1.*$/', $tag, $m) ) return $tag;
			ob_start();
			?>
			<style><?php echo file_get_contents( $m[2] ) ?></style>
			<?php
			$style = ob_get_contents();
			ob_end_clean();
			return $style;
		} else return $tag;
	}, 10, 2);

	// deferred scripts
	add_filter( 'script_loader_tag', function ( $tag, $handle ) {

		$_async = array(
			"wp-embed"
		);

		if ( in_array( $handle, $_async ) ) return str_replace( ' src', ' async src', $tag );

		$_defer = array();
		if ( in_array( $handle, $_defer ) ) return str_replace( ' src', ' defer src', $tag );

		if ( strpos ( $handle, "async-" ) === 0 ) return str_replace( ' src', ' async src', $tag );

		if ( strpos ( $handle, "defer-" ) === 0 ) return str_replace( ' src', ' defer src', $tag );

		return $tag;
	}, 10, 2);
?>
