class Accordion
	# Variables
	$ = jQuery # the jquery

	# INIT
	constructor: ($accordion) ->
		# Variables
		$li = $('.menu-item-has-children', $accordion) # get the li's with sub-menus

		# EVENTS
		# Open the item
		$li.on 'open', ->
			# close if it's already opened
			return $(@).trigger "close" if $(@).hasClass "open"

			# Add the opened class
			$(@).addClass "open"
			.siblings() # get the siblings
			.trigger "close" # and closes them

			$sub = $(".sub-menu", @) # the sub-menu

			# Get the height
			_h = $sub.height("auto").height()

			# clear the height
			$sub.height 0
			# then apply the calculed value
			.height _h

			# after the animation
			setTimeout ->
				# set height to auto
				$sub.height "auto"
			, 300

		# Close the item
		.on 'close', ->
			# return if it's not opened
			return if not $(@).hasClass "open"

			# remove the open class
			$(@).removeClass "open"

			# get the sub-menu
			$sub = $(".sub-menu", @)

			# Get the height
			_h = $sub.height("auto").height()

			# Apply the calculate height
			$sub.height _h
			# then set's to 0 (for animate)
			.height 0

			# After animation time
			setTimeout ->
				# remove the height style
				$sub.height ""
			, 300

		# LISTENERS
		# On click
		$li.on 'click', ->
			$(@).trigger "open" # trigger the open state of clicked item
		.on 'click', 'a', ( e ) ->
			e.stopPropagation()
			# console.log "lol"
			return true

(($) ->
	$(document).ready ->
		$('.accordion').each ->
			new Accordion $(@)
) jQuery
