(($) => {
	$(() => {
		$('.archive-categories select', '#archive').on("change", () => {
			(window as any).location.href = $(this).val();
		});
	});
})(jQuery);
