import jQuery from "jquery"

(($) => {
	$(() => {
		$('.banner-carousel').each( () => {
			$(this).owlCarousel({
				'items'				: 1,
				'autoplay'		: true,
				'animateIn'		: "fadeIn",
				'animateOut'	: "fadeOut",
				'rewind'			: true
			});
		});
	})
} ) ( jQuery )
