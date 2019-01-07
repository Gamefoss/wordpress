(($)->
	$(document).ready ->
		# on scroll
		$(window).on 'scroll', ->
			if $(window).scrollTop() + $(window).height()  > $(window).height() && $(window).scrollTop() + $(window).height() < $('#footer').offset().top
				$('.btn-up').addClass "show"
			else
				$('.btn-up').removeClass "show"
		# On button top click
		$('.btn-up').on 'click', ->
			$(@).removeClass "show"
			$('body,html').stop().animate {
				'scrollTop' : 0
				'easing': "easeInOutCubic"
			},{
				'duration': 1000
			}
) (jQuery)
