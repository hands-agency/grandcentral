(function($)
{
	$('.fieldEdit').on('change', function()
	{
		var $select = $(this);
		var $container = $select.closest('.fieldParamContainer');
		var form = $container.attr('data-form');
		var type = $select.attr('value');
		var value = $container.find('.fieldInheritedValue').attr('value');
		// alert(value);
		$container.find('.fieldDisplayContainer').ajx(
		{
			app: 'field',
			theme: 'default',
			template: 'field.ajax',
			form: form,
			type: type,
			value: value
		});
	});
	$('.fieldEdit').trigger('change');
})(jQuery);