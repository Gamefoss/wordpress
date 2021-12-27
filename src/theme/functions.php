<?php


/************************************
THEME CORE
************************************/
require_once('theme/theme.php');

/************************************
CUSTOM POSTS
************************************/
require_once( 'custom_posts/custom-post-type.php' );

/************************************
MODULES
************************************/
require_once('functions/modules.php');

/************************************
CUSTOM FUNCTIONS
************************************/
require_once('functions/custom-functions.php');

/************************************
CUSTOM HOOKS
************************************/
require_once('functions/custom-hooks.php');

/************************************
CRONS
************************************/
require_once('functions/cron.php');

/************************************
FEEDS
************************************/
require_once( "functions/feeds.php" );

/************************************
SHORTCODES
************************************/
require_once( 'functions/shortcodes.php' );

/* DON'T DELETE THIS CLOSING TAG */
?>
