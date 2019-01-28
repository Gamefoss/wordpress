<?php
	// QUOTE
	add_shortcode('quote', function ( $atts, $content = "" ) {
		$atts = shortcode_atts(array(
			'align'	=> "center"
		), $atts, 'quote' );
		ob_start();
		?>
			<blockquote class="quote align--<?php echo $atts['align'] ?>">
				<span><?php echo $content ?></span>
			</blockquote>
		<?php
		return ob_get_clean();
	} );

	// CLEAR
	add_shortcode( 'clear', function() {
		ob_start();
		?>
			<div class="cf"></div>
		<?php
		return ob_get_clean();
	} )

?>
