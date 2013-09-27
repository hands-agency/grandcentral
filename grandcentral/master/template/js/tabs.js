/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).ready(function ()
{
	$('.tabs li').click(function()
	{
	//	Set to off all the tabs, and set to on just "the one"
		$(this).siblings('.on').removeClass('on');
		$(this).addClass('on');
	
	//	Shortcut to the data
		link = $(this).find('a');
	//	App, theme and template
		app = 'section';
		template = link.data('template');
	
	//	Target section...
		section = link.data('section');
		panel = $('#section_'+section);
		panels = $(panel).get(0).tagName;

	//	Hide all panels
		$('#content section').hide();
	//	Open the right panel
		if (!$(panel).html() || $(this).hasClass('updateMe'))
		{
			$(panel)
				.show()
				.ajx(
				{
					app:app,
					template:template,
					section:section
				});
		//	Updated
			$(this).removeClass('updateMe');
		}
	//	Or just show it
		else
		{
			$(panel).show();
		}
	//	Change the main display
		$('#main').attr('class', $(panel).data('display'));
	//	Don't go to #stuff
		
	//	Bind the filter field
		$('#refine input').searchasyoutype(
		{
			app:app,
			theme:theme,
			template:template,
			section:section
		}, '#content section:visible');
	});

/*********************************************************************************************
/**	* Tabs : Open a section from the landing in the hash (or the first one)
	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	By hash
	if (window.location.hash) pseudo = '[href='+window.location.hash+']';
//	On demand
	else if ($('.tabs[data-default]').length) pseudo = '[href=#'+$('.tabs').data('default')+']';
//	By default
	else pseudo = ':first';
//	WRONG, not here...
	$(window).load( function(){$('.tabs li a'+pseudo).parent().trigger('click');} );
	
/*********************************************************************************************
/**	* On unlock
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).bind('unlock', function()
	{
		$('.tabs li:not(.on)').each(function()
		{
			li = $(this);
			droppable = li.find('.droppable');
			
		//	Center horizontally
			tabHeight = li.height()/2;
			droppableHeight = droppable.height()/2;
			droppable.css('top', '-'+(droppableHeight-tabHeight)+'px');
		//	Center vertically
			tabWidth = li.width()/2;
			droppableWidth = droppable.width()/2;
			droppable.css('left', '-'+(droppableWidth-tabWidth)+'px');
			
		//	All tabs are now droppable
			li.droppable(
			{
				tolerance: 'pointer',
				activeClass: 'ui-droppable-active',
				hoverClass: 'ui-droppable-hover',
				activate:function(event, ui)
				{
				},
				deactivate:function(event, ui)
				{
				},
				over:function(event, ui)
				{
				},
				out:function(event, ui)
				{
				},
				drop:function(event, ui)
				{
					tab = $(this);
				//	Our item's nickname
					item = $(ui.draggable).data('item');
				//	Change status
					$().ajx(
					{
						app: 'page',
						template: 'status',
						type: 'routine',
						item:item,
						status:tab.data('status'),
					}, {
					//	Done
						done:function()
						{	
						//	Confirm trash
							tab.effect('bounce', {distance:'30', times:'2'}, 250);
						//	Get rid of the item
							$(ui.draggable).hide('drop', {direction:'down'}, function(){$(this).remove();});
						//	Tell this tab to be updated next time
							tab.addClass('updateMe');
						//	Check if a section is empty now (todo)

						}
					});
				}
			});
		});
	});
});