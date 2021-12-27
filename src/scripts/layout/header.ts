(($) => {
	$(() => {
		const $header = $('header#header');
		search($('.search-header', $header));
		return mobile($header);
	})
	const search = ($search) => {
		
		const $btn = $('button', $search);
		const $input = $('input', $search);
		$btn.on('click', function (e) {
			if (!($input.val() as string).length) {
				e.preventDefault();
				if (!$search.hasClass("opened")) {
					$search.addClass("opened").prev().children(".socials").addClass("hide");
					$('input', $search).trigger('focus');
				} else {
					$search.removeClass("opened").prev().children(".socials").removeClass("hide");
				}
			}
		});
		$('.overlay', $search).on('click', (e) => {
			$search.removeClass("opened").prev().children(".socials").removeClass("hide");
		});
	};
	const mobile = ($header) => {
		const $btn_open = $('.btn-menu-mobile', $header);
		const $btn_close = $('.btn-close', $header);
		const $mobile_menu = $('.menu-container', $header);
		
		$mobile_menu
			.on('menu:open', function () {
				$mobile_menu.addClass("show");
				$header.addClass("menu-mobile-open");
				setTimeout(function () {
					$mobile_menu.addClass("opened");
					return $header.addClass("menu-mobile-opened");
				}, 300);
			})
			.on('menu:close', function () {
				$mobile_menu.removeClass("opened");
				$header.removeClass("menu-mobile-opened");
				setTimeout(function () {
					$mobile_menu.removeClass("show");
					return $header.removeClass("menu-mobile-open");
				}, 300);
			});
		
		$btn_open.on('click', function () {
			$mobile_menu.trigger("menu:open");
		});
		
		$btn_close.on('click', function () {
			$mobile_menu.trigger("menu:close");
		});
		$(".menu-nav", $mobile_menu).on('click', function (e) {
			e.stopPropagation();
			$mobile_menu.trigger("menu:close");
		}).on('click', ".menu", function (e) {
			e.stopPropagation();
		});
	};
})(jQuery);
