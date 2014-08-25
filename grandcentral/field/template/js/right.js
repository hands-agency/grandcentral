(function($)
{
//	Some vars
	var selector = 'li[data-type="right"]';
	
//	Display or hide the rights
	$(document).on('change', selector+' .level input[type=radio]', function()
	{
	//	Some vars
		val = $(this).val();
		$field = $(this).closest(selector);
		$rights = $field.find('.field');
		
	//	Show or hide rights
		if (val == 'admin') $rights.hide('fast');
		else $rights.show('fast');
	});
	
//	Change the item
	$(document).on('change', selector+' .field select', function()
	{
	//	Some vars
		item = $(this).val();
		$rights = $(this).closest('li').find('[name]');
		
	//	For each right change the item
		$rights.each(function()
		{
		//	regexp, catch all [0-9] or [] in the name of the field
			$(this).attr('name', $(this).attr('name').replace(/\[right\]\[allow\]\[[a-z0-9]*\]/i, '[right][allow]['+item+']'));
		});
	});
	
	
//	Add a line
	$(document).on('click', selector+' .add', function()
	{
	//	Some vars
		$field = $(this).closest(selector);
		$data = $field.find('.data');
		template = $field.find('.template');
		code = $(template.html());
		
	//	Append and enable
		$(this).before(code);
		$(code).show('fast').find('*:disabled').prop('disabled', false);
	});
	
//	Delete a line
	$(document).on('click', selector+' .delete', function()
	{
	//	Some vars
		$li = $(this).closest('li');
		
		$li.hide('fast', function(){$(this).remove();});
	});

})(jQuery); 