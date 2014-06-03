(function($)
{
//	Some vars
	selector = 'li[data-type="i18n"]';
	
//	Open the tabs
	$(selector).on('click', '.labels li', function()
	{
	//	Some vars
		$field = $(this).closest(selector);
		$fields = $field.find('> .wrapper > .field > ul');
		lang = $(this).data('lang');
		
	//	Hide all the fields and show the right oen
		$fields.find('> li').hide();
		$fields.find('> li[data-lang="'+lang+'"]').show();
		$(this).siblings().attr('class', 'off');
		$(this).attr('class', 'on');
	});

})(jQuery); 