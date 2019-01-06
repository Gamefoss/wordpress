( ($)->
	$(document).ready ->
		# verify impressions
		$('[data-name]','.ad').each ->
			if $(@).is(':visible')
				$.ajax
					'url'	: ajax.ajaxurl
					'type'	: "POST"
					'data'	:
						'action'	: "ajax_ad_impression"
						'name'		: $(@).data "name"

		# verify click
		$('[data-name]','.ad').on 'click', ->
			$.ajax
				'url'	: ajax.ajaxurl
				'type'	: "POST"
				'data'	:
					'action'	: "ajax_ad_click"
					'name'		: $(@).data "name"
)(jQuery)
