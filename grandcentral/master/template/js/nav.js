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
					if (!$(this).hasClass('edit')) openNav();
					
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
				var originalwidth = this.width();
				var timeoutOpen = 500;
				var timeoutClose = 500;
				
			//	When hover intent
				var config = {
					timeout: timeoutOpen,
					over: function()
					{
					},
					out: function(){}
				};
				this.find('> ul > li').hoverIntent( config );
		
			//	When out intended
				var config = {    
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
				};
				this.hoverIntent( config );
				
			//	Edit
				this.find('li.edit .editing').click(function()
				{
					openAdmin();
				});
				this.find('li.edit .edit').click(function()
				{
					openAdmin();
				});
				
			//	Close the nav by click
				this.find('button.close').click(function()
				{
					$nav.trigger('mouseleave');
				});
				
			//	Global Search
				$('#globalsearch').searchasyoutype(
				{
					app:'page',
					template:'snippet/cc-search',
				}, '#globalsearch-container');
			};
		})( jQuery );
	//	Go	
		$('#grandCentralNav').nav();
    });