(($)->
	# VARIABLES
	$container = $('#archive')

	$(document).ready ->

		# Iniciar carrossel de banner
		$('.archive-banner-carousel', $container).owlCarousel
			'items'				: 1
			'autoplay'		: true
			'animateIn'		: "fadeIn"
			'animateOut'	: "fadeOut"
			'rewind'			: true

		# LISTENERS
		# trocar a categoria por meio do select
		$('.archive-categories select', $container).on "change", ->
			window.location.href = $(@).val()
)(jQuery)
