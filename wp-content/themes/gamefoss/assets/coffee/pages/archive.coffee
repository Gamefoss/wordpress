( ($) ->
	# VARIABLES
	$container = $('#archive')

	$(document).ready ->
		# LISTENERS
		# change category by select
		$('.archive-categories select', $container).on "change", ->
			window.location.href = $(@).val()
) ( jQuery )
