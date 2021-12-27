(($) => {
	$(() => {
		$(window)
			.on('scroll', () => {
				if ($(window).scrollTop() + $(window).height() > $(window).height() && $(window).scrollTop() + $(window).height() < $('#footer').offset().top) {
					$('.btn-up').addClass("show");
				} else {
					$('.btn-up').removeClass("show");
				}
			});
		$('.btn-up').on('click', () => {
			$(this).removeClass("show");
			$('body,html').stop().animate({
				'scrollTop': 0,
				'easing': "easeInOutCubic"
			}, {
				'duration': 1000
			});
		});
	});
})(jQuery);
