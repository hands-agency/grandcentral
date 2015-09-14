/*********************************************************************************************
/**	* Grand Central continuity call (everything goes in POST, but current GET is rerooted)
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.continuity = function(options, callbacks, element)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {}
		
	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);

		//	What are we appending the ripple to
			$append = $('body');
				
		//	Prepare content layer
			$content = $('<div class="material-continuity-layer"><div class="material-continuity-ripple"></div><div class="material-continuity-content"><div class="material-continuity-close"></div>Content here</div></div>');
		//	Append content layer
			$append.append($content);
			
		//	Create the ripple
			$ripple = $content.find('material-continuity-ripple');
				
		//	Customize the ripple
			if (plugin.settings.css)
			{
				$.each(plugin.settings.css, function(selector, value)
				{
					$ripple.css(selector, value);
				});
			};
		//	Append ripple
			$ripple.appendTo($content);
			
		//	Show the content
			$element.on('click', function()
			{
				$('.material-continuity-layer').show(0, function()
				{
				//	Scale up the ripple
					$('.material-continuity-ripple').addClass('material-continuity-transitionned');	
				});
				
			});
		//	Resize the header after
		//	$('.material-continuity-ripple').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function()
		//	{
		//		$('.material-continuity-content').hide();
		//	});
			
		//	Close content layer
			$(document).on('click', '.material-continuity-close', function()
			{
			//	Hide the original element
				$('.material-continuity-ripple').removeClass('material-continuity-transitionned');
				
				$('.material-continuity-content').hide();
				
			});
		
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.continuity = function(options, callbacks)
	{
		return this.each(function()
		{
		//	if (undefined == $(this).data('continuity'))
		//	{
				var plugin = new $.continuity(options, callbacks, this);
				$(this).data('continuity', plugin);
		//	}
		});
	}
})(jQuery);