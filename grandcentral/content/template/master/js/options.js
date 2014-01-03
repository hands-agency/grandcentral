/*********************************************************************************************
/**	* Lock plugin
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
jQuery(document).ready(function($)
{
//	Plugin
	$.fn.lock = function(options)
	{
	//	Some vars
		$button = $(this);
		$drop = $('#options_drop');

	//	Toggle lock and unlock
		$(document).on('click', '#lock', function(event)
		{
		//	Unlock
			if ($('#content').hasClass('locked')) unlock();
		//	Or Lock
			else lock();
		});

	//	Lock the page to prevent further editing
		function lock()
		{
		//	IOI unlocked
			if ($('#content').hasClass('unlocked'))
			{				
			//	Hide option drop
				$drop.hide('fast');
			//	Say it with a class
				$('#content').toggleClass('unlocked locked');
				$button.toggleClass('icon-unlock icon-lock').toggleClass('on off');
			
			//	Trigger lock events
				$(document).trigger('lock');
			}
		}

	//	Unlock the page to allow editing
		function unlock()
		{
		//	IOI is locked
			if ($('#content').hasClass('locked'))
			{				
			//	Hide all the drops, so you can see what you're doing
				$('.help').hide('fast');
	
			//	Load the options drop
				$drop.ajx(
				{
					app:'master',
					template:'snippet/options.unlocked',
					section:$('#content section:visible').data('template'),
				},{
					done:function()
					{
					//	Show option drop
						$drop.show('fast');
					//	Say it with a class
						$('#content').toggleClass('unlocked locked');
						$button.toggleClass('on off').toggleClass('icon-unlock icon-lock');
					}
				});
				
			//	And then trigger the unlock events
				$(document).trigger('unlock');
			}
		}
	};

//	Go	
	$('#lock').lock();
});	

/*********************************************************************************************
/**	* FILTERS : filtering content of a section, ordering it.
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '#filter', function()
	{
	//	Some vars
		$button = $(this);
		$drop = $('#options_drop');
		
	//	Load the options drop
		$drop.ajx(
		{
			app:'master',
			template:'snippet/options.filters',
			sectiontype:$('#content section:visible').data('template'),
		},{
			done:function()
			{
			//	Toggle option drop and button
				$drop.toggle('fast');
				$button.toggleClass('on off');
			}
		});
	});

/*********************************************************************************************
/**	* Filtering content of a section, ordering it.
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '#options_drop li li', function()
	{
	//	Some vars
		panel = $('#content section:visible');
		filter = $(this).parent('ul').data('filter');
		section = panel.attr('id').replace('section_', '');
		value = $(this).data('value');
		template = panel.data('template');
		
	//	Toggle
		$(this).toggleClass('on off');
		
	//	Go
		switch(filter)
		{
		//	Reorder
			case 'order':
				panel.ajx(
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
			  $('#content').attr('class', value);
			  break;
		}
		
	//	Refresh
	});