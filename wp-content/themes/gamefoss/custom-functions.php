<?php

// ACF OPTIONS PAGE
if( function_exists('acf_add_options_page') ) acf_add_options_page();

// AD HANDLER
function ad( $size = 'square' ) {
  include(locate_template('modules/ad.php'));
}

// POST BLOCK HANDLER
function post_block( $_options = NULL ) {
  $options = array(
    'variation' => isset($_options['variation'])? $_options['variation'] : "highlight" ,
    'author'    => isset($_options['author'])? $_options['author'] : "default" ,
    'class'    => isset($_options['class'])? $_options['class'] : array()
  );
  include(locate_template('modules/post-block.php'));
}

?>
