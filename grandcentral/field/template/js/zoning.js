$(document).ready(function ()
{
/*********************************************************************************************
/**	* Zoning is a variation on the multiple select plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('[data-type="zoning"]').multipleselect(
	{		
		app:"field",
		template:"/zoning.available.section"
	}, {
	//	On Receive
		receive:function(item)
		{
		/* Only for new sections
		//	Some vars
			nickname = item.data('item').split('_');
			id = nickname[1];
			zone = item.closest('[data-zone]').data('zone');
			
		//	Make it visible
			item.addClass('focus');
			
		//	Configure the section
			openContext(
			{
				app: 'content',
				template: '/edit/edit',
				greenbutton:['savecontext_zoning'],
			//	_GET:{item:'section',fill:{app:{app:app},zone:zone}}
				_GET:{item:'section',id:id}
			});
		*/
		}
	});

/*********************************************************************************************
/**	* Add a method to the greenbutton plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').savecontext_zoning = function()
	{
	//	Save context and call back
		$('#greenbutton').data('greenbutton').savecontext(null, function()
		{
		//	Refresh the section
			$section = $('[data-type="zoning"] .focus');
			$section.removeClass('focus');
			id = $('.adminContext [data-key="id"] input').val();
			title = $('.adminContext [data-key="title"] input').val();
			app = $('.adminContext [data-key="app"] select').val();
			url = ADMIN_URL+'/iframe?section=section_'+id+'&page=page_'+_GET['id'];
			
		//	$section.find('iframe').attr('src', url);
			$section.find('.title a').html('<span>'+title+'</span><span class="app">'+app+'</span>');
			$section.find('input[type="hidden"]').val('section_'+id);
			
		//	Close context
			closeContext('/edit/edit');
		});
	}

/*********************************************************************************************
/**	* Edit section
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('[data-type="zoning"]').on('click', '.zone ol .title a', function()
	{
	//	Some vars
		section = $(this).parent().find('input[type="hidden"]').val();
		item = section.split('_')[0];
		id = section.split('_')[1];
		
	//	Make it visible
		$(this).parents('li').addClass('focus');
	
	//	Open context
		openContext(
		{
			app: 'content',
			template: '/edit/edit',
			greenbutton:['savecontext_zoning'],
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
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	resizeIframe = function(iframe)
	{
		iframe.on('load', function()
		{ 
 			height = $(this).contents().find('html').outerHeight()/2;
			iframe.parent('.preview').height(height);
		});
	}
//	Resize all iframes
	$('iframe').each(function(){resizeIframe($(this))});

/*********************************************************************************************
/**	* Emulate responsive
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('li[data-type="zoning"] .devices li').on('click', function()
	{
	//	Somevars
		$browser = $(this).closest('li[data-type="zoning"]').find('.zones');
		device = $(this).data('device');
		
	//	Change
		$(this).siblings().removeClass('on', '');
		$(this).addClass('on');
		$browser.attr('data-device', device);
	//	resizeIframe();
	});
//	Default
	$('li[data-type="zoning"] .devices li.default').trigger('click');
});