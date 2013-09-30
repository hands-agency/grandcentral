/*********************************************************************************************
/**	* Form validation plugin
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
//	Here we go!
	$.validate = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			id: $element.data('item').substring(5),
			key: $element.data('key'),
			fieldHasChanged: false,
			formIsValid: true,
			icon:{'ok':'icon-ok','ko':'icon-remove'},
			delay:{'ok':'1000','ko':'6500'},
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
	
		//	More vars
			vars['ajaxParam'] =
			{
				'type':'routine',
				'app':'form',
				'template':'validation.ajax',
				'form':vars['key'],
			};

		//	Remember when a field has changed
			$element.find('[name^="' + vars['key'] + '"]').live('input', function()
			{
				vars['fieldHasChanged'] = true;
			})
		
		//	Validate each field on blur
			$element.find('[name^="' + vars['key'] + '"]').live('blur', function()
			{
			//	But only if has changed
				if (vars['fieldHasChanged'] === true) plugin.field($(this).closest('li[data-key]'));
			});
		}

	//	Validate the whole form now
		plugin.now = function(callback)
		{
		//	Assume it's valid
			vars['formIsValid'] = true;
			maybeCallback = null;
		//	Test each first-level field 
			fields = $element.find('> fieldset > ol > li[data-key]');
			var len = fields.length;
			fields.each(function(index, element)
			{
			//	Callback only when all fields are tested
				if (index == len-1 && callback) maybeCallback = callback;
			//	Validate
				plugin.field($(this), maybeCallback);
			});
		}

	//	Validate a field
		plugin.field = function(field, callback)
		{
			var valid;
			var controlCode = '<div data-control=""></div>';
			var todoCode = '<ul class="todo"></ul>';
			var callback = callback;
			vars['ajaxParam']['field'] = field.data('key');
			vars['ajaxParam']['value'] = field.find('[name^="' + vars['key'] + '"]').val();
			request = $.ajax(
			{
				type: 'POST',
				async: true,
				url: ADMIN_URL+'/ajax',
				dataType: 'json',
				data: vars['ajaxParam'],
			});

		//	When done
			request.done(function(msg)
			{
			//	DEBUG (what validation.ajax.routine sends back)
			//	console.log(msg);
			
				$li = field;
			//	Start clean
				$li.removeClass('ok ko guiding');
				
			//	Field is OK
				if (msg === true)
				{
					css = 'ok';
					bounceDirection = 'up';
				//	Kill the todo list
					$li.find('.todo').css({'text-decoration':'line-through'}).hide('fast', function() {$(this).remove();});
					valid = true;
				//	Progressive saving
				//	$('#greenbutton').data('greenbutton').save();
				}
			//	Field is KO
				else
				{
					css = 'ko';
					bounceDirection = 'left';
				//	Append (maybe) and fill the todo list
					if ($li.find('.todo').length == 0) $li.find('.wrapper').append(todoCode);
					$li.find('.todo').html('<li>'+msg.required['descr']+'</li>').show('fast');
					valid = false;
				//	The whole form is not valid
					vars['formIsValid'] = false;
				}
			//	Append the control if needed
				if ($li.find('[data-control]').length == 0) $li.append(controlCode);
			//	Customize the control and the line
				$li.find('[data-control]')
					.html('')
					.attr('class', vars['icon'][css])
					.effect('bounce', {direction: bounceDirection, distance:'10', times:'2'}, 250)
					.delay(vars['delay'][css])
					.fadeOut('slow');
				$li.addClass(css);
				
			//	Back to normal
				vars['fieldHasChanged'] = false;
			
			//	And execute callbacks
				if (callback)
				{
					if (vars['formIsValid'] === true && callback['success']) callback['success']();
					else if (vars['formIsValid'] === false && callback['error']) callback['error']();
					if (callback['complete']) callback['complete']();
				}
			});
			
		//	If fail
			request.fail(function(msg) {console.log(msg.responseText);});
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.validate = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('validate'))
			{
				var plugin = new $.validate(this, options);
				$(this).data('validate', plugin);
			}
		});
	}
})(jQuery);