<?php

	// FEEDS

	// Add post thumbnail to default feed
	add_action('rss2_item', function () {
		global $post;
		if(has_post_thumbnail($post->ID)):
			$thumbnail = get_attachment_link(get_post_thumbnail_id($post->ID));
			echo("<image>{$thumbnail}</image>");
		endif;
	});

	// CUSTOM FEEDS
	// Custom feed for each house podcast
	function podcast_feed($_podcast) {
		header( 'Content-Type: application/rss+xml' );
		set_query_var('podcast', $GLOBALS['podcast']);
		get_template_part( 'rss/rss', 'podcast' );
		unset( $GLOBALS['podcast'] );
	}
	add_action('init', function () {
		foreach ( get_terms( "podcasts", array( 'hide_empty' => false) ) as $_podcast ) {
			$GLOBALS['podcast'] = $_podcast;
			if ( get_field( "external", $_podcast ) ) continue;
			add_feed("podcasts/{$_podcast->slug}", 'podcast_feed');
		}
	});

?>
