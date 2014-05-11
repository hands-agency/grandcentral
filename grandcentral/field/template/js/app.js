(function($)
{
//	Some vars content-side
	$field = $('[data-type="app"]');
	$contentApp = $field.find('[name$="\[app\]"]');
	$contentTemplate = $field.find('[name$="\[template\]"]');
	$contentParam = $field.find('[name$="\[param\]"]');
	$container = $contentApp.closest('.fieldAppContainer');
	$templateContainer = $container.find('.fieldTemplateContainer');
	
//	Some vars context-side
	contextDom = '#adminContext [data-template="/app.context"]';
	
//	Open context when the app changes
	$contentApp.change(function()
	{
	//	Reset template and params
		$contentTemplate.val('');
		$contentParam.val('');
	//	chargement des templates et paramètres
		var value = $contentApp.val();
		var params = $templateContainer.attr('data-param');
		if ($templateContainer.data('appkey') != value)
		{
			params = null;
		};
		if (value)
		{
			openContext(
			{
				app: 'field',
				template: '/app.context',
				env: $container.data('env'),
				name: $container.data('name'),
				appkey: value,
				valueTemplate: $templateContainer.data('template'),
				valueParam: params
			});
		}
	});
	
//	Open context to manage template and params
	$container.on('click', 'button', function()
	{
		$contentApp.trigger('change');
	});
	
//	Send template and params to content
	$(document).on('click', contextDom+' button', function()
	{
	//	Some vars
		$context = $(contextDom);
		$contextTemplate = $context.find('.template select');
		$contextParam = $context.find('.param :input');
		
	//	Start Fresh
		$templateContainer.html('');
		
	//	Write template
		template = $contextTemplate.val();
		if (template)
		{
			input = '<input type="hidden" name="'+$container.data('name')+'[template]" value="'+template+'" />';
			$templateContainer.append(input);
		}
		
	//	Write params
		param = $contextParam.serializeArray();
		if (param)
		{
			for (var i=0; i < param.length; i++)
			{
				input = '<input type="hidden" name="'+$container.data('name')+'[param]['+param[i]['name'] +']" value="'+param[i]['value']+'" />';
				$templateContainer.append(input);
			}
		}
	//	Close the context & validate field
		closeContext();
		$('#section_edit form').data('validate').field($field);
	});
})(jQuery);  