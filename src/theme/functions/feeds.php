<?php

	// FEEDS

	// Add post thumbnail to default feed
	/*add_action('rss2_item', function () {
		global $post;
		if(has_post_thumbnail($post->ID)):
			$thumbnail = get_attachment_link(get_post_thumbnail_id($post->ID));
			echo("<image>{$thumbnail}</image>");
		endif;
	});*/

	function featuredtoRSS($content) {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ) return '' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
		return $content;
	}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');

	// CUSTOM FEEDS
	// PODCAST
	// Custom feed for each house podcast
	add_action('init', function () {
		foreach ( get_terms( "podcasts", array( 'hide_empty' => false) ) as $_podcast ) {
			if ( get_field( "external", $_podcast ) ) continue;
			add_feed("podcasts/{$_podcast->slug}", function() use ( $_podcast ) {
				header( 'Content-Type: application/rss+xml' );
				set_query_var('podcast', $_podcast);
				get_template_part( 'rss/rss', 'podcast' );
			});
		}
	});

?>
