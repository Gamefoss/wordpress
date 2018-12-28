( ($) ->
	$(document).ready ->
		# Iniciar carrossel de banner
		$('.banner-carousel').each ->
			$(@).owlCarousel
				'items'				: 1
				'autoplay'		: true
				'animateIn'		: "fadeIn"
				'animateOut'	: "fadeOut"
				'rewind'			: true
) ( jQuery )
