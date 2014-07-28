$(document).ready(function ()
{
/*********************************************************************************************
/**	* Multiple
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"]').multipleselect(
	{		
		app:"field",
		template:"/zoning.available"
	});

/*********************************************************************************************
/**	* Popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"] .zone ol .title').on('click', function()
	{
	//	Some vars content-side
		$li = $('[data-type="zoning"]');
		$field = $li.find('.field');
		$contentApp = $field.find('[name$="\[app\]"]');
		$configureContainer = $field.find('.configure');
		$contentTemplate = $configureContainer.find('.template');
		$contentParam = $configureContainer.find('.param');
	
	//	Some vars context-side
		contextDom = '#adminContext [data-template="/app.context"]';
	
	//	Some vars
		valueApp = $contentApp.val();
		if (valueApp == '') return false;
		valueTemplate = $contentTemplate.find('[name$="\[template\]"]').val();
		valueParam = $contentParam.find('[name*="\[param\]"]').serializeArray();
		// Sometimes we have a content-type as a template filter
		valueContenttype = ($('[data-type="pagetype"]').length != 0) ? $('[data-type="pagetype"] [name$="\[content_type\]"]').val() : undefined;
		
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
		return false;
	});
});