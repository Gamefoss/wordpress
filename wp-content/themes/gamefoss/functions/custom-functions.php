<?php

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
				'date'          => date("Y-m-d H:i:s", strtotime($item->pubDate) ),
				'mp3'           => reset($item->enclosure['url'])
			));
		}
	}
	return $episodes;
}

// UPDATE podcasts episodes
function gf_update_podcasts_feeds_func () {
	$podcasts = get_terms( "podcasts", array( 'hide_empty' => false) ); // get all the podcasts

	foreach ( $podcasts as $podcast ) {

		if ( !get_field( "external", $podcast ) ) continue; // verify if it's external (if not, ignore)

		$feed = get_podcast_feed( get_field( "rss_feed", $podcast ) ); // get it's feed

		$_posts_titles = array(); // episodes titles array

		// get all the titles from episodes alrealdy saved in gamefoss website
		foreach ( get_posts( array(
			'post_type' 	=> "podcast",
			'numberposts'	=> -1
		) ) as $post ) {
			array_push( $_posts_titles, sanitize_title( $post->post_title ) );
		}

		// foreach episode
		foreach ( $feed as $episode ) {

			$_shouldadd = true; // by default, it will be a new episode

			// verify if it's title alrealdy exists
			if ( in_array( sanitize_title( $episode->title ),  $_posts_titles ) ) $_shouldadd = false;

			// if it's a new episode, add a post
			if ( $_shouldadd ) {
				wp_insert_post( array(
					'post_author'		=> 1,
					'post_content'	=> $episode->description,
					'post_title'		=> $episode->title,
					'post_status'		=> "publish",
					'post_type'			=> "podcast",
					'post_date'			=> $episode->date,
					'tax_input'			=> array(
						'podcasts'	=> $podcast->term_id
					),
					'meta_input'		=> array(
						'url'					=> $episode->url,
						'mp3'					=> $episode->mp3
					)
				) );
			} else {
				// if not, update info
				// get post by search it's title
				$_post = get_posts(array(
					's'	=> $episode->title,
					'post_type'		=> "podcast"
				));
				$_post = reset($_post);

				// UPdate the info
				wp_update_post(array(
					'ID'					=> $_post->ID,
					'post_title'	=> $episode->title,
					'post_content'	=> $episode->description,
					'post_date'			=> $episode->date,
					'tax_input'			=> array(
						'podcasts'	=> $podcast->term_id
					),
					'meta_input'		=> array(
						'url'					=> $episode->url,
						'mp3'					=> $episode->mp3
					)
				));
			}
		}
	}
}

// GET IMAGE
function get_featured_image($id = false, $size = 'large') {
	if (!$id) $id = get_the_ID();
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
	if(is_array($img)) {
		$img = reset($img);
	}

	if (!$img) {

		$_post = get_post($id);
		switch ($_post->post_type) {
			case 'podcast':
				$_podcast = get_the_terms($_post, "podcasts");
				$_podcast = reset($_podcast);
				$img = get_field("logo", $_podcast);
				break;
		}
	}
	return $img;
}

require_once( "feeds.php" );


?>
