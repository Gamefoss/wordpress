(($)->
	$(document).ready ->
		# LISTENERS
		# WINDOW RESIZE
		$(window).on 'resize', ->
			$('.post-block--container').each ->
				_h = 0
				$('.post-block', @)
				.height ""
				.each ->
					_h = $(@).height() if $(@).height() > _h
				.height _h

		# On load, trigger resize
		.trigger "resize"
)(jQuery)
