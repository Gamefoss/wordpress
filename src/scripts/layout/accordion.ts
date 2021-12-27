class Accordion {
	constructor(
		private readonly $: JQueryStatic,
		private readonly $accordion: JQuery<typeof globalThis>
	) {
		this.$('.menu-item-has-children', $accordion)
			.on( 'open', () => {
				if ($(this).hasClass("open")) {
					return $(this).trigger("close");
				}
				
				$(this).addClass("open").siblings().trigger("close");
				
				const $sub = $(".sub-menu", this);
				const _h = $sub.height("auto").height();
				
				$sub.height(0).height(_h);
				
				return setTimeout(function() {
					return $sub.height("auto");
				}, 300);
			})
			.on( 'close', () => {
				if (!$(this).hasClass("open")) {
					return;
				}
				
				$(this).removeClass("open");
				
				const $sub = $(".sub-menu", this);
				const _h = $sub.height("auto").height();
				
				$sub.height(_h).height(0);
				
				return setTimeout(function() {
					return $sub.height("");
				}, 300);
			})
			.on( 'click', () => {
				return $(this).trigger("open");
			} )
			.on( 'click', 'a', (e) => {
				e.stopPropagation();
				return true;
			} );
	}
}

(($) => {
	$(() => {
		$('.accordion').each(() => {
			const accordion = new Accordion($, $(this));
			console.log('accordion', accordion);
		});
	});
})(jQuery)
