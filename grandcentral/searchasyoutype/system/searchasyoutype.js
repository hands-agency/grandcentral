/*********************************************************************************************
/**	* Form validation plugin
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.searchasyoutype = function(element, options, callbacks)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			timing:700,
			timeout:null,
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
			
		//	Search on type
			$element.on('input', function()
			{
			//	Some vars
				$search = $(this);
			
			//	Stop current action
				clearTimeout(plugin.settings.timeout);
			//	Start a new one
				plugin.settings.timeout = setTimeout(function()
				{
				//	Fetch the q value
					q = $search.val();
				//	Target can be a jQuery object or a selector
					$target = (plugin.settings.target instanceof jQuery) ? plugin.settings.target : $(plugin.settings.target);

				//	Refresh the target
				  	$target.ajx(
					{
						app:plugin.settings.app,
						template:plugin.settings.template,
						param:plugin.settings.param,
						q:q,
					}
					, callbacks);
				}, plugin.settings.timing);
			});
		
		//	Prevent Submit
			$(element).keypress(function(e)
			{
			    if ( e.which == 13 ) e.preventDefault();
			});
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.searchasyoutype = function(options, callbacks)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('searchasyoutype'))
			{
				var plugin = new $.searchasyoutype(this, options, callbacks);
				$(this).data('searchasyoutype', plugin);
			}
		});
	}
})(jQuery);