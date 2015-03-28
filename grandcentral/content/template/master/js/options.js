/*********************************************************************************************
/**	* Lock plugin
* 	* @author	@mvdandrieux
**#******************************************************************************************/
jQuery(document).ready(function($)
{
//	Here we go!
	$.lock = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	Some vars
			$drop = $('header .drawer');

		//	Toggle lock and unlock
			$element.on('click', function()
			{
				if ($('#adminContent').hasClass('locked')) plugin.unlock();
				else plugin.lock();
			});
		}
		
	//	Lock the page to prevent further editing
		plugin.lock = function()
		{	
		//	IOI unlocked
			if ($('#adminContent').hasClass('unlocked'))
			{
			//	Say it with a class
				$('#adminContent').toggleClass('unlocked locked');
				$element.toggleClass('icon-unlock icon-lock').toggleClass('on off');
		
			//	Trigger lock events
				$(document).trigger('lock');
			}
		}

	//	Unlock the page to allow editing
		plugin.unlock = function()
		{
		//	IOI is locked
			if ($('#adminContent').hasClass('locked'))
			{
			//	Load the options drop
				$drop.ajx(
				{
					app:'content',
					template:'master/snippet/options.unlocked',
					section:$('#adminContent section.active').data('template'),
				},{
					done:function()
					{
					//	Show option drop
					//	$drop.show('fast');
					//	Say it with a class
						$('#adminContent').toggleClass('unlocked locked');
					}
				});
			
			//	And then trigger the unlock events
				$(document).trigger('unlock');
			}
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.lock = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('lock'))
			{
				var plugin = new $.lock(this, options);
				$(this).data('lock', plugin);
			}
		});
	}

//	Go	
	$('.lock').lock();
});

/*********************************************************************************************
/**	* FILTERS : filtering content of a section, ordering it.
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '#filter', function()
	{
	//	Some vars
		$button = $(this);
		$drawer = $('header .admin .drawer');
		
		if ($drawer.hasClass('closed'))
		{
		//	Open Drawer
			$drawer.toggleClass('closed opened');
		//	Load the options drop
			$drawer.ajx(
			{
				app:'content',
				template:'/master/snippet/options.filters',
				sectiontype:$('#adminContent section.active').data('template'),
			},{
				done:function()
				{
				//	Toggle option drop and button
					$button.toggleClass('on off');
				//	Resize the header after
					$drawer.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function()
					{
						height = $('header .admin').outerHeight();
						$('#adminContent').css('padding-top', height+'px');
					});
				}
			});
		}
		else $drawer.toggleClass('opened closed');
	});

/*********************************************************************************************
/**	* Filtering content of a section, ordering it.
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', 'header .drawer li li[data-value]', function()
	{
	//	Some vars
		$panel = $('#adminContent section.active');
		$filter = $(this).parent('ul');
		filter = $filter.data('filter');
		section = $panel.attr('id').replace('section_', '');
		value = $(this).data('value');
		template = $panel.data('template');
		
	//	Toggle
		if ($filter.data('type') == 'exclusive') $filter.children().removeClass('on').addClass('off');
		$(this).toggleClass('on off');
		
	//	Go
		switch(filter)
		{
		//	Reorder
			case 'order':
		//	Sort
			case 'sort':
				$panel.ajx(
				{
					app:'content',
					template:template,
					section:section,
					filter:filter,
					value:value,
				});
				break;
		//	Change display
			case 'display':
				$panel.attr('data-pref-display', value);
			  break;
		}
		
	//	Refresh
	});