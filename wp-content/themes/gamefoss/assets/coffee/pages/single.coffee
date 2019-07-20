( ($) ->
	# VARIABLES
	$container = $('#single')

	$(document).ready ->
		# LISTENERS
		# owl Carousel
		$('.single-content .carousel', $container).each ->
			
			$carousel = $(@)
			
			$carousel.addClass "owl-carousel"
			.owlCarousel
				responsive		:
					nav			: false
					dots		: true
					# navText		: ["", ""]
					0			:
						items	: 1
					768			:
						items	: $(@).attr("class").split("columns-")[1].slice(0,1)
						# nav		: true
) ( jQuery )
