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
	contextDom = '.adminContext[data-template="/app.context"]';
	
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
		if (valueApp == '') return false;
		valueTemplate = $contentTemplate.find('[name$="\[template\]"]').val();
		valueParam = $contentParam.find('[name*="\[param\]"]').serializeArray();
		// Sometimes we have a content-type as a template filter
		valueContenttype = ($('[data-type="pagetype"]').length != 0) ? $('[data-type="pagetype"] [name$="\[content_type\]"]').val() : undefined;
		
	//	Open Context to configure
		// console.log($('input[data-key="key"]').val())
		openContext(
		{
			app: 'field',
			template: '/app.context',
			env: $field.data('env'),
			item:_GET.item+'_'+_GET.id,
			itemKey:$('input[data-key="key"]').val(),
			name: $field.data('name'),
			valueApp: valueApp,
			valueContenttype: valueContenttype,
			valueTemplate: valueTemplate,
			valueParam: valueParam,
		},
		function()
		{
			$(contextDom+' .template select').trigger('change');
		});
	});
	
//	Send template and params to content
	$(document).on('click', contextDom+' button.done', function()
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
				var name;
				//	field selectors
				if (param[i]['name'].indexOf("[") != -1)
				{
					var d = param[i]['name'].match(/([a-zA-Z_0-9\-]*)\[([a-zA-Z_0-9\-]*)\]/);
					name = $field.data('name')+'[param]['+ d[1] +']['+ d[2] +']';
				}
				// others
				else
				{
					name = $field.data('name')+'[param]['+ param[i]['name'] +']';
				}
				input = '<textarea name="'+name+'" style="display:none">'+param[i]['value']+'</textarea>';
				$contentParam.append(input);
			}
		}
	//	Close the context & validate field
		closeContext('/app.context');
		$('#section_edit form').data('validate').field($li);
	});
	
//	Open context when the app changes
	$(document).on('change', contextDom+' .template select', function()
	{
		var $ol = $(contextDom+' .param ol');
		$ol.find('li[data-specialdataname="param"]').remove();
		valueParam = $contentParam.find('[name*="\[param\]"]').serializeArray();
		// console.log($(this).val())
		$.ajx(
		{
			app: 'field',
			template: '/app.param',
			env: $field.data('env'),
			name: $field.data('name'),
			valueApp: $contentApp.val(),
			valueTemplate: $(this).val(),
			valueParam: valueParam
		},{
			done:function(data)
			{
				// console.log(data)
				$(contextDom+' .param ol').html($(contextDom+' .param ol').html() + data);
			}
		});
	});
})(jQuery);  