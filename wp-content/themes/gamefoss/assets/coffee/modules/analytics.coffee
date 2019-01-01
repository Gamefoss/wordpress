(($)->
	$(document).ready ->
		# LISTENERS

		# DATA CLICK
		$(document).on 'click', '[data-analytics]', ->
			# variables
			data = $(@).data "analytics"
			.split "|"

			send_event
				'category'	: data[0] || false
				'action'		: data[1] || false
				'label'			: data[2] || false
				'value'			: data[3] || 0


		# SEARCH SUBMIT
		$('form[name=search]').on "submit", ->
			send_event
				'category'	: "search"
				'action'		: "submit"
				'label'			: "query"
				'value'			: $('input[name=s]', @).val()

			# facebook event
			if typeof(fbq) != "undefined"
				fbq 'track', 'Search',
			    'search_string'	: $('input[name=s]', @).val()

	send_event = ( data ) ->
		# send event to google analytics
		if typeof(ga) != "undefined"
			ga "send",
				'hitType'				: "event"
				'eventCategory'	: data.category
				'eventAction'		: data.action
				'eventLabel'		: data.label
				'eventValue'		: data.value

)(jQuery)
