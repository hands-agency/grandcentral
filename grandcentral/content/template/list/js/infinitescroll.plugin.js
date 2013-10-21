/*********************************************************************************************
/**	* Form validation plugin
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.infinitescroll = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			round:0,
			range:options.param.limit,
			rangeFrom:'0',
			rangeTo:options.param.limit,
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
			
		//	Load more content
			$('.infiniteScrollWantsMore').on('click', function()
			{
				plugin.load();
			});
		
		//	Load the first content
			plugin.load();
		}
		
	//	Load content
		plugin.load = function()
		{
		//	Change range
			plugin.settings.rangeFrom = plugin.settings.range * plugin.settings.round;
			plugin.settings.rangeTo = plugin.settings.rangeFrom + plugin.settings.range;
			plugin.settings.param.limit = plugin.settings.rangeFrom+', '+plugin.settings.rangeTo;
			
		//	Load
			$.ajx(
				plugin.settings.param,
				{
					done:function(html)
					{
						$element.append(html);
					}
				},
				{mime:'html'}
			);
			
		//	Increment round of loading
			plugin.settings.round++;
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.infinitescroll = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('infinitescroll'))
			{
				var plugin = new $.infinitescroll(this, options);
				$(this).data('infinitescroll', plugin);
			}
		});
	}
})(jQuery);