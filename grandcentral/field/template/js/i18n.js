(function($)
{
//	Some vars
	var selector = 'li[data-type="i18n"] .labels li, li[data-type="url"] .labels li';
	
//	Open the tabs
	$(document).on('click', selector, function()
	{
	//	Some vars
		$field = $(this).closest('[data-type]');
		$fields = $field.find('> .wrapper > .field > ul');
		$labels = $field.find('> .wrapper > .labels');
		lang = $(this).data('lang');
		
	//	Hide all the fields and show the right one
		$fields.find('> li').hide();
		$fields.find('> li[data-lang="'+lang+'"]').show();
		
		$labels.find('> li').attr('class', 'off');
		$labels.find('> li[data-lang="'+lang+'"]').attr('class', 'on');
	});

})(jQuery); 