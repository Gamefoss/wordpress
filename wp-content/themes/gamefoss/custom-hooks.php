<?php
  // PODCAST FEED UPDATE ON SAVE
  add_action( 'save_post', function ( $post_id, $post, $update) {
    // If saved post is a podcast type post, update the feeds
    if ( get_post_type( $post_id ) == "podcast") {
      gf_update_podcasts_feeds_func( $post_id );
    }
  }, 10, 3 );
?>
