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
				
				$nav.on('click', '>ul>li', function()
				{
				//	Open the drawer
					if (!$(this).hasClass('editing')) openNav();
					
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
				//	Fade-out useless UI elements
					$nav.find('> ul > li').not('.on').fadeTo('fast', 0.2);
				//	$('#main').fadeTo(null, 0.2);
				//	$('#context').hide();

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
						
						$nav.find('li').removeClass('on');
					//	Hide all sub navs
						$nav.find('ul li .sub').hide();
					//	Fade-in UI useful elements
						$nav.find('> ul > li').fadeTo('fast', 1);
					}
				};
				this.hoverIntent( config );
				
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