/*********************************************************************************************
/**	* Nav plugin
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).ready(function ()
	{
      	(function($)
		{	
		//	Plugin
			$.fn.nav = function()
			{
			//	Shortcut
				var $nav = $(this);
				
			//	Open drawer
				$nav.on('click', '>ul>li', function()
				{
				//	Open the drawer (except for the edit buttons)
					if (!$(this).hasClass('edit') & !$(this).hasClass('editing')) openNav();
					
				//	Some vars
					subnav = $(this).find('.sub');
					subnavs = $nav.find('ul li .sub');

				//	We're on!
					$(this).parent().find('li').removeClass('on');
				//	Hide all sub navs
					subnavs.hide();

				//	Show this nav
					$(subnav).show();
					$(this).addClass('on');

				//	Show current
					$(this).fadeTo('fast', 1);	
				});
				
			//	Some var
				var timeoutClose = 500;
		
			//	When out intended
				this.hoverIntent(
				{    
					timeout: timeoutClose,
					over: function() {},
					out: function()
					{
					//	Close the drawer
						closeNav();
					//	Nothing is on
						$nav.find('li').removeClass('on');
					//	Hide all sub navs
						$nav.find('ul li .sub').hide();
					}
				});
				
			//	Close the nav by click
				this.find('button.close').click(function()
				{
					$nav.trigger('mouseleave');
				});
				
			//	Global Search
			/*	$('#globalsearch').searchasyoutype(
				{
					app:'page',
					template:'snippet/cc-search',
				}, '#globalsearch-container');

				
			//	Edit
				this.find('li.edit a').click(function()
				{
					nickname = $('#grandCentralSite iframe').contents().find('head meta[property="gc:item"]').attr('content').split('_');
					window.location = ADMIN_URL+'/edit?item='+nickname[0]+'&id='+nickname[1];
				});
			*/
			};
		})( jQuery );
	//	Go	
		$('#adminNav').nav();
    });