(function ($)
{
	$(document).on('click', '.seofilter-link', function (e)
	{
		e.preventDefault();

		$(this).closest('label').trigger('click');
	});
})(jQuery);