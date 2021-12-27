(function($) {
	$(() => {
		$(window).on('resize', function() {
			$('.post-block--container').each(function() {
				let _h = 0;
				$('.post-block', this).height("").each(function() {
					if ($(this).height() > _h) {
						_h = $(this).height();
					}
				}).height(_h);
			});
		}).trigger("resize");
	});
})(jQuery);
