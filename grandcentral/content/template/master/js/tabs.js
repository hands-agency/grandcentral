/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).ready(function ()
{
	$('#tabs li').click(function()
	{
	//	Set to off all the tabs, and set to on just "the one"
		$(this).siblings('.on').removeClass('on');
		$(this).addClass('on');
	
	//	Shortcut to the data
		link = $(this).find('a');
	//	App, theme and template
		app = link.data('app');
		template = link.data('template');

	//	Target section...
		param = link.attr('data-param'); /* We want the string, not the object */
		$panel = $('#section_'+section);
		panelWidth = $panel.outerWidth()+40;
		
	//	Hide all panels
		$('#adminContent section').removeClass('active');
	//	Hide options
	//	TODO refresh content instead of hide
		$('#options_drop').hide('fast');
	//	Open the right panel
		if (!$panel.html() || $(this).hasClass('updateMe'))
		{
		//	Fetch content
			$panel
				.addClass('loading')
				.ajx(
				{
					app:app,
					template:template,
					param:param
				}, {
				//	Done
					done:function()
					{
					//	Say it's loaded
						$panel.removeClass('loading');
					}
				});
		}
		
	//	Show
		index = $panel.parent().index();
		left = (panelWidth) * (index);
		$('#sectiontray').css('left', '-'+left+'px');		
	//	Say it's updated
		$panel.removeClass('virgin updateMe').addClass('active');
						
	//	Change the main display
		$('#main').attr('class', $panel.data('display'));

	});

/*********************************************************************************************
/**	* Tabs : Open a section from the landing in the hash (or the first one)
	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	By hash
	if (window.location.hash) pseudo = '[href='+window.location.hash+']';
//	On demand
	else if ($('#tabs[data-default]').length) pseudo = '[href=#'+$('#tabs').data('default')+']';
//	By default
	else pseudo = ':first';
//	WRONG, not here...
	$(window).load( function(){$('#tabs li a'+pseudo).parent().trigger('click');} );
	
/*********************************************************************************************
/**	* Sticky nav
	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	var $main = $('#main');
	var $header = $('header');
	var stickyNavTop = $header.offset().top;
  
	var stickyNav = function()
	{  
		var scrollTop = $(document).scrollTop();

	//	parallax
		$('#grandCentralSite iframe').css('top', scrollTop/2);
		$('#grandCentralSite h1').css('top', 50+(((scrollTop/250)/2)*100)+'%');
       
		if (scrollTop > stickyNavTop)
		{
			if ($main.not('.sticky'))
			{
		    	$main.addClass('sticky');
			}
		}
		else
		{
			$main.removeClass('sticky'); 
		}  
	}
	
	$(document).scroll(function()
	{
	    stickyNav();
	});  
	
/*********************************************************************************************
/**	* On unlock
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).bind('unlock', function()
	{
		$('#tabs li:not(.on)').each(function()
		{
			li = $(this);
		//	All tabs are now droppable
			li.droppable(
			{
				tolerance: 'pointer',
				activeClass: 'ui-droppable-active',
				hoverClass: 'ui-droppable-hover',
				drop:function(event, ui)
				{
					tab = $(this);
				//	Our item's nickname
					item = $(ui.draggable).data('item');
				//	Change status
					$.ajx(
					{
						app: 'content',
						template: 'status',
						item:item,
						status:tab.data('status'),
					}, {
					//	Done
						done:function()
						{	
						//	Confirm status change
						//	tab.effect('bounce', {distance:'30', times:'2'}, 250);
						//	Get rid of the item
							$(ui.draggable).hide('drop', {direction:'down'}, function(){$(this).remove();});
						//	Tell this tab to be updated next time
							tab.addClass('updateMe');
						//	Check if a section is empty now (TODO)

						}
					});
				}
			});
		});
	});
});