/*********************************************************************************************
/**	* itemcards
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
//	Plugin
	$.itemcards = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			container:'<div id="itemcards"></div>',
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
			
			var timeoutOpen = 500;
			var timeoutClose = 500;
					
		//	When hover intent
			var config = {
				timeout: timeoutOpen,
				over: function()
				{
					console.log($(this));
					
				/*
				//	Check if popup exists
					if ($('#itemcards').length == 0)
					{
					//	Append code
						$('body').append(plugin.settings.container);
					}
					
					li = $(this);
					item = li.data('item');

				//	Position
					top = '100px';
					left = '100px';
					
				//	Populate
					$('#itemcards')
						.css({'top': '100px', 'left': '100px'})
						.show('fast')
						.ajx(
						{
							app: 'itemcards',
							theme: 'default',
							template: 'cardcontent',
							item: item,
						},
						{
							'done':function(){}
						});
					*/
				},
				out: function(){console.log('out');}
			};
		
		//	Fire
			$(document).on('hoverIntent', '[data-item]', config );
			
		//	Create on demand
			plugin.create();
		}
		
	//	Create the cards on demand
		plugin.create = function()
		{

		}

	//	Fire up the plugin!
		plugin.init();
	};

//	Add the plugin to the jQuery.fn object
	$.fn.itemcards = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('itemcards'))
			{
				var plugin = new $.itemcards(this, options);
				$(this).data('itemcards', plugin);
			}
		});
	}
})(jQuery);