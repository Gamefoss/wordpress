(($)->
	# VARIABLES
	$container = $('#archive')

	$(document).ready ->
		# Iniciar carrossel de banner
		$('.ludokratia-banner-carousel', $container).owlCarousel
			'items'				: 1
			'autoplay'		: true
			'animateIn'		: "fadeIn"
			'animateOut'	: "fadeOut"
			'rewind'			: true
)(jQuery)
