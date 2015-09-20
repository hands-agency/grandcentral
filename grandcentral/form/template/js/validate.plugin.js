/*********************************************************************************************
/**	* Form validation plugin
 	* @author	@mvdandrieux
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
			delay:{'ok':'1500','ko':'10000'},
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
	
		//	More vars
			vars['ajaxParam'] =
			{
				'app':'form',
				'template':'validation',
				'form':vars['key'],
				'mime':'json',
			};

		//	Remember when a field has changed
			$element.on('input', '[name^="' + vars['key'] + '"]', function()
			{
				vars['fieldHasChanged'] = true;
			})
		
		//	Validate each field on blur
			$element.on('blur', '[name^="' + vars['key'] + '"]', function()
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
			input = field.find('[name^="' + vars['key'] + '"]');
			
			vars['ajaxParam']['field'] = field.data('key');
			vars['ajaxParam']['value'] = input.val();
			vars['ajaxParam']['required'] = input.attr('required');
			
		//	Try to validate
			$.ajx(vars['ajaxParam'],
			{
			//	Callback
				done:function(msg)
				{
				//	DEBUG (what validation.routine sends back)
				//	console.log(msg);
					meta = msg.meta;
					data = msg.data;
				
				//	Some vars
					$li = field;
				
				//	Field is OK
					if (meta.status == 'success')
					{
						css = 'ok';
						icon = 	'';
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
						icon = '';
						
					//	Append (maybe) and fill the todo list
						if (data && typeof data.error != 'undefined')
						{
							if ($li.find('.todo').length == 0) $li.find('.wrapper').first().append(todoCode);

							$.each(data.error, function( index, error )
							{
	 							$li.find('.todo').html('<li>'+error.descr+'</li>').show('fast');
							});
						}
						valid = false;
					//	The whole form is not valid
						vars['formIsValid'] = false;
					}
					
				//	Control!
					showControl($li,
					{
					//	html:css,
						feathericon:icon,
						timeout:vars['delay'][css],
						control:css,
					});
				
				//	Back to normal
					vars['fieldHasChanged'] = false;
			
				//	And execute callbacks
					if (callback)
					{
						if (vars['formIsValid'] === true && callback['success']) callback['success']();
						else if (vars['formIsValid'] === false && callback['error']) callback['error']();
						if (callback['complete']) callback['complete']();
					}
				},
			});
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