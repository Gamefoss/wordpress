(($) => {
	return $(() => {
		$('.single-content .carousel', '#single').each(() => {
			$(this).addClass("owl-carousel").owlCarousel({
				nav: false,
				dots: true,
				items: 1,
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: +$(this).attr("class").split("columns-")[1].slice(0, 1)
					}
				}
			});
		});
	});
})(jQuery);
