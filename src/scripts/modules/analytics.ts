(($) => {
	
	$(() => {
		$(document).on('click', '[data-analytics]', function() {
			const data = $(this).data("analytics").split("|");
			send_event({
				'category': data[0] || false,
				'action': data[1] || false,
				'label': data[2] || false,
				'value': data[3] || 0
			});
		});
		$('form[name=search]')
			.on("submit", function() {
			send_event({
				'category': "search",
				'action': "submit",
				'label': "query",
				'value': $('input[name=s]', this).val()
			});
			(window as any)?.fbq('track', 'Search', {
					'search_string': $('input[name=s]', this).val()
				});
		});
	});
	const send_event = function(data) {
		(window as any)?.ga("send", {
			'hitType': "event",
			'eventCategory': data.category,
			'eventAction': data.action,
			'eventLabel': data.label,
			'eventValue': data.value
		});
	};
})(jQuery);
