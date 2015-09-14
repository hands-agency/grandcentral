(function($)
{
	$(document).on('blur', '[name="app[cover]"]', function()
	{
		$('section header .cover').css('background-image', 'url("'+$(this).val()+'")');
	});
})(jQuery);