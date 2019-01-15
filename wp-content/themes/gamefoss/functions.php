<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
// require_once( 'theme/bones.php' );

// LOAD THEME CORE
require_once('theme/theme.php');


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

/* DON'T DELETE THIS CLOSING TAG */
?>
