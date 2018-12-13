<?php

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
}

// AD HANDLER
function ad( $size = 'square' ) {
	include(locate_template('modules/ad.php'));
}

// POST BLOCK HANDLER
function post_block( $_options = NULL ) {
	$options = array(
		'variation' => isset($_options['variation'])? $_options['variation'] : "post-block--vertical" ,
		'author'    => isset($_options['author'])? $_options['author'] : "default" ,
		'class'    => isset($_options['class'])? $_options['class'] : array()
	);
	include(locate_template('modules/post-block.php'));
}

// CURL
function _curl( $url ) {
	// VARIABLES
	$curl = null;
	$result = null;
	// Fetch feed from URL
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);

	// proper USER-AGENT...
	curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");

	$result = curl_exec($curl);
	curl_close($curl);

	return $result;
}


// PODCASTS FEED HANDLERS
function get_podcast_feed( $rss ) {
	$feed = _curl( "{$rss}?format=xml" );
	$episodes = array();
	if($feed && !empty($feed)) {
		$feedXml = @simplexml_load_string($feed);
		foreach ( $feedXml->channel->item as $item ) {
			array_push($episodes, (object) array(
				'title'         => reset($item->title),
				'url'           => reset($item->link),
				'description'   => nl2br(reset($item->description)),
				'date'          => date( strtotime($item->pubDate) ),
				// 'mp3'           => reset($item->enclosure['url'])
			));
		}
	}
	return $episodes;
}

// UPDATE podcasts meta field
function gf_update_podcasts_feeds_func( $post_id = false ) {
	// If have a post parameter
	if ( $post_id ) {
		$post = get_post( $post_id ); // get the post
		// update it's meta rss value
		$feed = get_podcast_feed( get_field( "rss_feed" , $post->ID ) );
		if ($feed && sizeof( $feed )) {
			delete_post_meta( $post->ID, "feed");
			add_post_meta( $post->ID, "feed", $feed );
		}
	} else {
		// otherwise, get all podcast type post
		foreach ( get_posts( array(
			'post_type'   => "podcast",
			'numberposts' => -1
		) ) as $post ) {
			// update it's meta rss value
			$feed = get_podcast_feed( get_field( "rss_feed" , $post->ID ) );
			if ($feed && sizeof( $feed )) {
				delete_post_meta( $post->ID, "feed");
				add_post_meta( $post->ID, "feed", $feed );
			}
		}
	}
}
?>
