(($) => {
		$(() => {
			$('[data-name]', '.ad').each(() => {
				if ($(this).is(':visible')) {
					$.ajax({
						'url': (window as any).ajax.ajaxurl,
						'type': "POST",
						'data': {
							'action': "ajax_ad_impression",
							'name': $(this).data("name")
						}
					});
				}
			});
			$('[data-name]', '.ad').on('click', function() {
				$.ajax({
					'url': (window as any).ajax.ajaxurl,
					'type': "POST",
					'data': {
						'action': "ajax_ad_click",
						'name': $(this).data("name")
					}
				});
			});
		})
	})(jQuery);
