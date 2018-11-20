<?php

// PODCASTS FEED CRON
if ( ! wp_next_scheduled( 'gf_update_podcasts_feeds' ) ) {
  wp_schedule_event( time(), 'twicedaily', 'my_task_hook' );
}

add_action( 'gf_update_podcasts_feeds', 'gf_update_podcasts_feeds_func' );

?>
