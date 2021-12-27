(($) => {
	$(() => {
		$('a.icon-facebook', '.share').on('click', (e) => {
			e.preventDefault();
			(window as any)?.FB.ui({
				'method': "share",
				'href': window.location.href
			}, (response) => {
				console.log(response);
			});
		});
	});
})(jQuery);
