/*********************************************************************************************
/**	* Form validation plugin
 	* @author	mvd@cafecentral.fr
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
			
		//	Some vars
			var selector = 'li[data-type="'+vars.type+'"] > .wrapper > .field .data';
		//	Make the selected sortable
			$(selector).sortable(
			{
				items:'> li:not(.nodata)',
				axis:'y',
				tolerance:'pointer',
				handle: '> .handle',
			});
		}
		
	//	Added buttons
		plugin.addButtons = function()
		{
		//	Some vars
			var selector = 'li[data-type="'+vars.type+'"] > .wrapper > .field > .add button';
			
		//	Add buttons
			$(document).off('click', selector).on('click', selector, function()
			{
			//	Some vars
				var button = $(this);
				var add = button.data('type');
				var field = button.closest('li[data-type]');
				var wrapped = field.find('> .wrapper > .field');
				var data = wrapped.find('> .data');
				var nodata = wrapped.find('> .nodata');
			//	Enable and fill up the container
				var template = wrapped.find('> .template .'+add).html();
				var wrapped = field.find('> .wrapper > .field');
				$(template).appendTo(data).show('fast').find('*:disabled').not('.template *:disabled').prop('disabled', false);
				
			//	No data
				if (data.children().length > 0) nodata.hide();
				
			//	Callback
				if (plugin.settings['onAdd']) plugin.settings['onAdd'](field);
				// console.log(data.find('> li'))
				var id = makeid();
				// console.log(id)
				data.find('li input').each(function()
				{
					input = $(this);
					name = input.attr('name');
					input.attr('name', name.replace(/\[\]/i, "["+id+"]"));
				});
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
				nodata = data.parent().find('.nodata');

			//	Hide smoothly
				li.hide('slide', { direction: 'up' }, 100, function()
				{
				//	Remove
					$(this).remove();
				//	No data
					if (data.children().length == 0) nodata.show();
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

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}