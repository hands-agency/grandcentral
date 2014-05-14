(function($)
{
//	Some vars content-side
	$li = $('[data-type="app"]');
	$field = $li.find('.field');
	$contentApp = $field.find('[name$="\[app\]"]');
	$configureContainer = $field.find('.configure');
	$contentTemplate = $configureContainer.find('.template');
	$contentParam = $configureContainer.find('.param');
//	Some vars context-side
	contextDom = '#adminContext [data-template="/app.context"]';
	
//	Open context when the app changes
	$contentApp.change(function()
	{
	//	Reset template and params
		$contentTemplate.html('');
		$contentParam.html('');
	//	Configure
		$field.find('button').click();
	});
	
//	Open context to manage template and params
	$field.on('click', 'button', function()
	{
	//	Some vars
		valueApp = $contentApp.val();
		valueTemplate = $contentTemplate.find('[name$="\[template\]"]').val()
		valueParam = $contentParam.find('[name*="\[param\]"]').serialize();
		// Sometimes we have a content-type as a template filter
		valueContenttype = ($('[data-type="pagetype"]').length != 0) ? $('[data-type="pagetype"] [name$="\[content_type\]"]').val() : undefined;
		
	//	Open Context to configure
		openContext(
		{
			app: 'field',
			template: '/app.context',
			env: $field.data('env'),
			name: $field.data('name'),
			valueApp: valueApp,
			valueContenttype: valueContenttype,
			valueTemplate: valueTemplate,
			valueParam: valueParam,
		});
	});
	
//	Send template and params to content
	$(document).on('click', contextDom+' button', function()
	{
	//	Some vars
		$context = $(contextDom);
		$contextTemplate = $context.find('.template select');
		$contextParam = $context.find('.param :input');
		
	//	Start Fresh
		$contentTemplate.html('');
		$contentParam.html('');
		
	//	Write template
		template = $contextTemplate.val();
		if (template)
		{
			input = '<input type="hidden" name="'+$field.data('name')+'[template]" value="'+template+'" />';
			$contentTemplate.append(input);
		}
		
	//	Write params
		param = $contextParam.serializeArray();
		if (param)
		{
			for (var i=0; i < param.length; i++)
			{
				input = '<input type="hidden" name="'+$field.data('name')+'[param]['+param[i]['name'] +']" value="'+param[i]['value']+'" />';
				$contentParam.append(input);
			}
		}
	//	Close the context & validate field
		closeContext();
		$('#section_edit form').data('validate').field($li);
	});
})(jQuery);  