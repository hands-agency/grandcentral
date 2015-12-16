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
			item.addClass('focusByContext');
			
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
		$('#greenbutton').data('greenbutton').savecontext(null, function(response)
		{
		//	Some vars
			meta = response.meta;
			data = response.data;

		//	Refresh the section
			id = data.id;
			title = data.title;
			app = data.app.app;
			url = ADMIN_URL+'/iframe?section=section_'+id+'&page=page_'+_GET['id'];
			
		//	$('[data-type="zoning"] [data-item="'+meta.item+'"]').find('iframe').attr('src', url);
			$('[data-type="zoning"] [data-item="'+meta.item+'"] .title').html('<span>'+title+'</span><span class="app">'+app+'</span>').parent().effect('highlight', {color:'#FFC000'}, 1000);
		//	$('[data-type="zoning"] [data-item="'+meta.item+'"]').find('input[type="hidden"]').val('section_'+id);
			
		//	Close context
			closeContext('/edit/edit');
		});
	}

/*********************************************************************************************
/**	* Edit section
* 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('[data-type="zoning"]').on('click', '.zone ol .title', function()
	{
	//	Make it visible
		$(this).parents('li').addClass('focusByContext');
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