(($)->
	# VARIABLES
	$container = $('#archive')

	$(document).ready ->
		# LISTENERS
		# trocar a categoria por meio do select
		$('.archive-categories select', $container).on "change", ->
			window.location.href = $(@).val()
)(jQuery)
