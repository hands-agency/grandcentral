/*********************************************************************************************
/**	* Form validation plugin
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.addable = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
	//	Plugin's variables
		var vars = {
			type : $element.data('type'),
		}
		
	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
			
		//	Some binds the add and delete buttons
			plugin.addButtons();
			plugin.deleteButtons();
		}
		
	//	Added buttons
		plugin.addButtons = function()
		{
		//	Some vars
			selector = 'li[data-type="'+vars.type+'"] > .wrapper > .field > .add button';
		
		//	Add buttons
			$(document).off('click', selector).on('click', selector, function()
			{
			//	Some vars
				button = $(this);
				add = button.data('type');
				field = button.closest('li[data-type]');
				wrapped = field.find('> .wrapper > .field');
				data = wrapped.find('> .data');

			//	Enable and fill up the container
				template = wrapped.find('> .template .'+add).html();
				$(template).appendTo(data).show('fast').find('*:disabled').not('.template *:disabled').prop('disabled', false);
				
			//	Focus?
				
			//	Callback
				if (plugin.settings['onAdd']) plugin.settings['onAdd'](field);
			});
		}
		
	//	Delete buttons
		plugin.deleteButtons = function()
		{
		//	Some vars
			selector = 'li[data-type="'+vars.type+'"] > .wrapper > .field > .data button.delete';
			
		//	Delete buttons
			$(document).off('click', selector).on('click', selector, function()
			{
			//	Some vars
				li = $(this).closest('li');
				data = li.parent();

			//	Hide smoothly
				li.hide('slide', { direction: 'up' }, 100, function()
				{
				//	Remove
					$(this).remove();
				});	
			});
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.addable = function(options)
	{
		return this.each(function()
		{
		//	NOT a singleton
		//	if (undefined == $(this).data('addable'))
		//	{
				var plugin = new $.addable(this, options);
				$(this).data('addable', plugin);
		//	}
		});
	}	
})(jQuery);