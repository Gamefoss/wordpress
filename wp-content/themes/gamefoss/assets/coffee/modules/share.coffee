( ($) ->
	$(document).ready ->
		# VARIABLES
		$share = $('.share');
		$('a.icon-facebook', $share).on 'click', (e) ->
			e.preventDefault()
			FB.ui
				'method'	: "share"
				'href'		: window.location.href
			, (response) ->
				console.log response
)(jQuery)
