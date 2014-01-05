/*********************************************************************************************
/**	* Trashbin plugin
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.trashbin = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			show_bottom:'50px',
			hide_bottom:'-100px',
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
			
		//	Make droppable
			$element.droppable(
			{
				hoverClass:'hover',
				tolerance:'pointer',
				activate:function(event, ui)
				{
				//	$element.find('.cc-bubble').effect('bounce', {distance:'10', times:'2'}, 250).delay(1000).hide('fast');
				},
				deactivate:function(event, ui)
				{
				//	$(this).find('.cc-bubble').hide('fast');
				},
				drop:function(event, ui)
				{
				//	Our item's nickname
					item = $(ui.draggable).data('item');
				//	Send to the trashbon !
					plugin.send(item, function()
					{						
					//	Get rid of the objet
						byebye = $(ui.draggable);
						byebye.hide('drop', {direction:'down'});
					});
				}
			});
		}

	//	Show
		plugin.show = function()
		{
			$element.removeClass('hidden').addClass('visible');
		}

	//	Hide
		plugin.hide = function()
		{
			$element.removeClass('visible').addClass('hidden');
		}
		
	//	Toggle
		plugin.toggle = function()
		{
			$element.toggleClass('visible hidden');
		}
		
	//	Send
		plugin.send = function(item, callback)
		{
		//	Go to trash
			$.ajx(
			{
				app: 'content',
				template: 'status',
				item:item,
				status:$element.data('status'),
			}, {
			//	Done
				done:function(html)
				{
				//	Confirm trash
					$element.effect('bounce', {distance:'30', times:'2'}, 250);
				//	Callback
					if ((typeof(callback) != 'undefined') && (typeof(callback) == "function")) callback.call(this, html);
				}
			});
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.trashbin = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('trashbin'))
			{
				var plugin = new $.trashbin(this, options);
				$(this).data('trashbin', plugin);
			}
		});
	}
})(jQuery);
