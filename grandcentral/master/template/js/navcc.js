/*********************************************************************************************
/**	* Nav plugin
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).ready(function ()
	{
      	(function($)
		{	
		//	Plugin
			$.fn.navcc = function()
			{
			//	Shortcut
				var $nav = $(this);
				
			//	Some var
				var originalwidth = this.width();
				var timeoutOpen = 500;
				var timeoutClose = 500;
				
			//	Open the nav
				$(document).on('click', 'header .nav', function()
				{
					$nav.show('fast');
				});
				
			//	When hover intent
				var config = {
					timeout: timeoutOpen,
					over: function()
					{
					//	Some vars
						subnav = $(this).find('.sub');
						subnavs = $nav.find('ul li .sub');
						width = originalwidth+subnav.outerWidth(true);

					//	We're on!
						$(this).parent().find('li').removeClass('on');
					//	Hide all sub navs
						subnavs.hide();

					//	Open the drawer
						if (originalwidth != width) $nav.animate({width:width+'px'}, 70);
					//	Show this nav
						$(subnav).show();
						$(this).addClass('on');
					//	Fade-out useless UI elements
						$nav.find('> ul > li').not('.on').fadeTo('fast', 0.2);
					//	$('#main').fadeTo(null, 0.2);
					//	$('#context').hide();

					//	Show current
						$(this).fadeTo('fast', 1);
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
						$nav.animate({width:originalwidth+'px'}, 100);
						$nav.find('li').removeClass('on');
					//	Hide all sub navs
						$nav.find('ul li .sub').hide();
					//	Fade-in UI useful elements
						$nav.find('> ul > li').fadeTo('fast', 1);
					//	$('#main').fadeTo(null, 1);
					//	$('#context').show();
						$nav.hide('fast');
					}
				};
				this.hoverIntent( config );
				
			//	Close the nav by click
			/*	this.find('button').click(function()
				{
					$nav.trigger('mouseleave');
				});
			*/
				
			//	Global Search
				$('#globalsearch').searchasyoutype(
				{
					app:'page',
					theme:'default',
					template:'inc/cc-search',
				}, '#globalsearch-container');
			};
		})( jQuery );
	//	Go	
		$('#nav-cc').navcc();
    });