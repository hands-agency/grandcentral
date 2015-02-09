$(document).ready(function ()
{
/*********************************************************************************************
/**	* Zoning is a variation on the multiple select plugin
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"]').multipleselect(
	{		
		app:"field",
		template:"/zoning.available"
	}, {
	//	On Receive
		receive:function(item)
		{
		//	Some vars
			app = item.data('app');
			zone = item.closest('[data-zone]').data('zone');
			
		//	Make it visible
			item.addClass('focus');
			
		//	Create a new section
			openContext(
			{
				app: 'content',
				template: '/edit/edit',
				mode: 'context',
				_GET:{item:'section',fill:{app:{app:app},zone:zone}}
			});
		}
	});

/*********************************************************************************************
/**	* Edit section
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"]').on('click', '.zone ol .title', function()
	{
	//	Some vars
		section = $(this).parent().find('input[type="hidden"]').val();
		item = section.split('_')[0];
		id = section.split('_')[1];
	
	//	Open context
		openContext(
		{
			app: 'content',
			template: '/edit/edit',
			mode: 'context',
			_GET:{item:item,id:id}
		});
		return false;
	});
/*
	$('[data-type="zoning"]').on('click', '.zone ol .title', function()
	{
	//	Some vars content-side
		$li = $('[data-type="zoning"]');
		$field = $li.find('.field');
		$section = $(this).closest('li');
		$contentApp = $section.find('[name$="\[app\]"]');
		$configureContainer = $section.find('.configure');
		$contentTemplate = $configureContainer.find('.template');
		$contentParam = $configureContainer.find('.param');
	
	//	Some vars context-side
		contextDom = '.adminContext[data-template="/app.context"]';
	
	//	Some vars
		valueApp = $section.data('app');
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
			itemKey:$section.data('section'),
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

/*********************************************************************************************
/**	* Resize ìframe content
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	resizeIframe = function(iframe)
	{
		iframe.on('load', function()
		{ 
 			height = $(this).contents().find('html').outerHeight()/2;
			iframe.parent('.preview').height(height);
		});
	}
	$('iframe').each(function(){resizeIframe($(this))});
});