/*********************************************************************************************
/**	* Popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
//	Plugin
	$.popup = function(element, options)
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
		
	//	Plugin's shortcuts
		popup = '#popup';
		overlay =  '#popup_overlay';
		container = '#popup_container';
		close = '#popup_close, #popup .cancel button';
		content = '#popup_content';

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);

		//	Check if popup exists
			if ($(popup).length == 0)
			{
			//	Append code
				code = '<div id="popup" style="display:none;"><div id="popup_overlay"><div id="popup_container"><button type="button" id="popup_close"></button><div id="popup_content"></div></div></div></div>';
				$('body').append(code);
			}
			
		//	Ways to open
			$element.on('click', function()
			{
				plugin.show();
			});
			
		//	Ways to close
			$(document).on('click', overlay, function()
			{
			//	Only on the element, not on its children
				if(event.target === this) plugin.hide();
			});
			$(document).on('click', close, function()
			{
				plugin.hide();
			});
			$(document).keyup(function(e)
			{
				if (e.keyCode == 27) plugin.hide();
			});
		
		//	AutoOpen when instanciating ?
			if (plugin.settings.autoOpen === true) plugin.show();
		}
		
	//	Show
		plugin.show = function()
		{
		//	No scroll
			$('body').addClass('popupActive');
		//	CSS
			$(container)
				.css('width', plugin.settings['width'])
				.css('minHeight', plugin.settings['height']);
			if (!plugin.settings['top']) plugin.settings['top'] = 100;
		//	Show popup
			$(popup).show();
		//	Calculate new full height for overlay
			$(overlay).height($(window).height());
		//	Position
			$(container).css('top', plugin.settings['top']);
		//	Load content
			$(content).ajx(plugin.settings);
		};
		
	//	Hide
		plugin.hide = function()
		{
		//	No scroll
			$('body').removeClass('popupActive');
		//	Ready to restart clean
			$(content).html('');
		//	Hide popup
			$(popup).hide();
		};

	//	Fire up the plugin!
		plugin.init();
		
	//	Prevent <a> link
		return false;
	};

//	Add the plugin to the jQuery.fn object
	$.fn.popup = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('popup'))
			{
				var plugin = new $.popup(this, options);
				$(this).data('popup', plugin);
			}
		});
	}
})(jQuery);