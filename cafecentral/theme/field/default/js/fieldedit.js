(function($)
{
//	The field type selector
	selector = '[data-type="fieldedit"] select';
	currentType = $(selector).val();
	
//	Display the properties of a field
	$(document).on('change', selector, function()
	{
	//	Some vars
		select = $(this);
		container = select.parents('.field').find('.fieldProperties');
		form = select.parents('form').data('key');
		type = select.val();
		field = select.parents('[data-type="'+currentType+'"]');
		key = field.data('key');
	//	Refresh
		$.ajx(
		{
			app: 'field',
			theme: 'default',
			template: 'fieldedit.properties',
			form: form,
			field: key,
			type: type,
			currentType: currentType,
		},{
			done:function(html)
			{
			//	Doesn't work in the jQuery object context like container.ajx()... don't know why.
				container.html(html);
			}
		});
	});
	
//	Load the properties for the current field
	$(selector).trigger('change');
})(jQuery);