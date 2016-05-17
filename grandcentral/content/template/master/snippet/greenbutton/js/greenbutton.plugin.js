/*********************************************************************************************
/**	* Form validation plugin
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.greenbutton = function(element, options)
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

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);
	
		//	Load and change the labels
			$('#tabs li').click(function()
			{
			//	Some vars
				link = $(this).find('a');
				section = link.data('section');
			//	The different choices
				dflt = $('#section_'+section).data('greenbutton');

			//	If you have choices
				if (dflt)
				{
					$('#greenbutton').show();
				//	Label and action
					label = dflt['title'][$('html').attr('lang')];
					action = dflt['key'];
					icon = dflt['icon'];
					color = dflt['color'];
				//	Add possible callback
					if ($('#section_'+section).data('callback'))
					{
						callback = $('#section_'+section).data('callback');
						label = label+' + '+callback;
						action = action+'_'+callback;
					}
				//	Go
					$('#greenbutton-default')
						.html(label)
						.data('action', action)
						.attr('data-feathericon', icon);
					$('#greenbutton').css('background-color', '#'+color);
				}
			//	No choices
				else $('#greenbutton').hide();
			//	else console.log('No choices for green button, not good');
			});

		//	Trigger main action
			$(document).on('click', '#greenbutton-default', function()
			{
				$(this).toggleClass('on');
			});

		//	Show the minor actions
			$(document).on('click', '#greenbutton-or', function()
			{
				$(this).toggleClass('on');
			//	Fetch the right section
				sectionkey = $('#adminContent section.active').data('key');
			//	Open the context
				openContext(
				{
					app:'content',
					template:'master/snippet/greenbutton/greenbutton.context',
					sectionkey:sectionkey,
				});
			});

		//	A click a button triggers a method
			$(document).on('click', '#greenbutton-default, .greenbutton-choices a', function()
			{
				method = $(this).data('action');
				canbesaved = ['live', 'live_reach', 'live_back', 'live_new'];

			//	Create & execute the method
				var fn = plugin[method];
				fn();
				
			//	Save as the prefered method if authorized
				sectionkey = $('#adminContent section.active').data('key');
				console.log(canbesaved.indexOf(method));
				if (canbesaved.indexOf(method) != -1)
				{
					$.api(
					{
						method:'post',
						url:'api.json/v1/pref/greenbutton/'+sectionkey+'/'+method,
					},{
						done:function(msg)
						{
						//	console.log(msg);
						}
					});
				}
			});
			
		//	Prevent regular submit
			$(document).on('submit', '.adminContext form, #adminContent>section form', function()
			{
				return false;
			});
		}
		
	//	Add a choice to the greenbutton
		plugin.add = function(action)
		{
		//	Go to the form page
			$('section.active').data('greenbutton', action).attr('data-greenbutton', action);
			
		//	Reinit Greenbutton
			$('#tabs li.on').trigger('click');
		}
		
	//	New
		plugin.new = function()
		{
		//	Go to the form page
			document.location.href = ADMIN_URL+'/edit?item='+_GET['item'];
		}

	//	Save
		plugin.save = function(newStatus, callback)
		{
		//	Some vars
			$forms = $('#adminContent section form');
			
		//	Save all forms in a section
			$forms.each(function()
			{
			//	Some vars
				$form = $(this);
				inFlow = false;
				
			//	Trigger regular submit for eventual plugin callbacks (like Sir Trevor)
				$form.submit();
				
			//	Id & status
				id = $form.find('input[name$="[id]"]');
				$oldStatus = $form.find('input[name$="[status]"]');
				
			//	Change status to an original status ?
				if (newStatus == 'live' || newStatus == 'asleep' || newStatus == 'trash') 
				{
					$oldStatus.val(newStatus);
					status = newStatus;
				}
			//	Keep status or go in the workflow
				else
				{
				//	Go to the workflow !
					if (newStatus)
					{
						status = newStatus;
						inFlow = "&workflow=" + encodeURIComponent(newStatus);
					}
				//	Keep old status if no change or asleep
					if ($oldStatus.val()) status = $oldStatus.val();
				//	No status at all draft in the workflow
					else
					{
					//	status = 'draft';
					//	inFlow = "&workflow=" + encodeURIComponent(status);
					}
				}
			
			//	Form data
				data = $form.serialize();
				if (inFlow != false) data += inFlow;
				
			//	Ajaxify forms
				$.ajax(
				{
					url: $form.attr('action'),
					type: $form.attr('method'),
					data: data,
					success: function(r)
					{
						console.log(r);
					//	Some vars
						meta = r.meta;
						data = r.data;
						
					//	Ajax sends back the item
						if ($.isNumeric(data.id))
						{
							$('#greenbutton-default').removeClass('on');
						//	Updat the form with new data
							if (!_GET['id'])
							{
								$.each(data, function(key, value)
								{
									$field = $form.find('[name$="'+_GET['item']+'['+key+']"]');
								//	Update if empty
									if ($field.length && $field.val().length == 0) $field.val(value);
								});
							}
						//	Rewrite URL if changed
							if (_GET['item'])
							{
								_GET['id'] = data.id;
								item = (inFlow != false) ? 'workflow' : _GET['item'];
							//	BAM
								url = '?item='+item+'&id='+_GET['id'];
								if (window.location.hash) url += window.location.hash;
								window.history.pushState('string', 'chose', url);
							}
						//	Pop alert
							if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) popAlert(status, status, callback(r));
							else popAlert(status, status);
						};
					},
					error:function(r)
					{			
						console.log(r.responseText);
					},
				});
			});
			
			
		}

	//	Save and back
		plugin.save_back = function()
		{
			plugin.save(null, function()
			{
			//	Go to the list page
				document.location.href = ADMIN_URL+'/list?item='+_GET['item'];
			});
		}

	//	Save and reach
		plugin.save_reach = function()
		{
			plugin.save(null, function()
			{
			//	Reach
				openSite(CURRENTEDITED_URL);
			//	document.location.href = CURRENTEDITED_URL;
			});
		}

	//	Go live
		plugin.live = function(callback)
		{
		//	Validate forms before go live
			$('section form').data('validate').now(
			{
				success:function(html)
				{
				//	Submit all forms	
					plugin.save('live', callback);
				},
				error:function()
				{			
				//	Pop alert
					popAlert('error', 'Couple of things missing.');
				//	console.log('error');
				},
				complete:function()
				{
				//	console.log('complete');
				},
			});
		}

	//	Go live and go back to the list
		plugin.live_back = function()
		{
			plugin.live(function()
			{
			//	Go to the list page
				document.location.href = ADMIN_URL+'/list?item='+_GET['item'];
			});
		}

	//	Go live and reach
		plugin.live_reach = function()
		{
			plugin.live(function()
			{
			//	Reach
				openSite(CURRENTEDITED_URL);
			//	document.location.href = CURRENTEDITED_URL;
			});
		}

	//	Go live and start anew
		plugin.live_new = function()
		{
			plugin.live(function()
			{
			//	Go to the form page
				document.location.href = ADMIN_URL+'/edit?item='+_GET['item'];
			});
		}

	//	Asleep
		plugin.asleep = function()
		{
		//	Submit all forms	
			plugin.save('asleep');
		}

	//	Asleep and go back to the list
		plugin.asleep_back = function()
		{
			plugin.save('asleep', function()
			{
			//	Go to the list page
				document.location.href = ADMIN_URL+'/list?item='+_GET['item'];
			});
		}

	//	Googlepreview
		plugin.googlepreview = function()
		{
		//	Save a draft
			plugin.save('draft', function(r)
			{
			//	Some vars
				key = r.data.key;
				wfUrl = SITE_URL+'/wf?key='+key;
				
			//	Open preview
				openSite(wfUrl);
			//	Close choices, open the preview
				closeContext('master/snippet/greenbutton/greenbutton.context');
				openContext(
				{
					app:'content',
					template:'master/snippet/googlepreview',
				}, function()
				{	
					$site = $('#siteContent');
				//	We update the preview based on real <head> data
					$site.load(function()
					{
					//	Some vars
						title = $site.contents().find('title').html();
						descr = $site.contents().find('meta[name="description"]').attr('content');
						url = $site.contents().find('link[rel="canonical"]').attr('content');
						$preview = $('.adminContext[data-template="master/snippet/googlepreview"] .true');

					//	Update the Preview
						$preview.append('<div class="title"><a href="">'+title+'</a></div>');
						$preview.append('<div class="descr"><a href="">'+descr+'</a></div>');
						$preview.append('<div class="url"><a href="">'+url+'</a></div>');
					});
				});
			});
		}

	//	Save a copy
		plugin.save_copy = function()
		{
			_GET['id'] = '';
			$('input[name="'+SITE_KEY+'_'+_GET['item']+'[id]"]').val('');
		//	Get rid of id and save
			plugin.save();
		}

	//	Save and go back to the list
		plugin.save_back = function()
		{
			plugin.save(null, function()
			{
			//	Go to the list page
				document.location.href = ADMIN_URL+'/list?item='+_GET['item'];
			});
		}

	//	Save and start anew
		plugin.save_new = function()
		{
			plugin.save(null, function()
			{
			//	Go to the form page
				document.location.href = ADMIN_URL+'/edit?item='+_GET['item'];
			});
		}

	//	Trash
		plugin.trash = function()
		{
			plugin.save('trash');
		}

	//	Trash and go back to the list
		plugin.trash_back = function()
		{
			plugin.save('trash', function()
			{
			//	Go to the list page
				document.location.href = ADMIN_URL+'/list?item='+_GET['item'];
			});
		}

	//	Preview
		plugin.preview = function()
		{
			plugin.save('draft', function(r)
			{
				key = r.data.key;
				url = SITE_URL+'/wf?key='+key;
				openSite(url, true);
			});
		}

	//	Workflow
		plugin.workflow = function()
		{
			console.log('bon...');
		}

	//	New page
		plugin.newpage = function()
		{
			$('.lock').data('lock').unlock();
			$('#greenbutton-default').removeClass('on');
		}

	//	New workflow
		plugin.newworkflow = function()
		{
		//	Go to the form page
			document.location.href = ADMIN_URL+'/edit?item=workflow';
		}

	//	New system page
		plugin.newsystem = function()
		{
		//	Go to the form page
			document.location.href = ADMIN_URL+'/edit?item='+_GET['item']+'&fill[system]=1';
		}

	//	Edit item
		plugin.edititem = function()
		{
		//	Go to the form page
			document.location.href = ADMIN_URL+'/edit?item='+_GET['item'];
		}
		
	//	Save the form in the context panel
		plugin.savecontext = function(newStatus, callback)
		{
		//	Trigger regular submit for eventual plugin callbacks (like Sir Trevor)
			$('.adminContext form').submit();
		//	Id & status
			id = $('input[name="'+SITE_KEY+'_'+_GET['item']+'[id]"]');
			$oldStatus = $('input[name="'+SITE_KEY+'_'+_GET['item']+'[status]"]');
			$form = $('.adminContext form');

		//	Change status ?
			if (newStatus) 
			{
				$oldStatus.val(newStatus);
				status = newStatus;
			}
		//	Keep old status
			else if ($oldStatus.val()) status = $oldStatus.val();
		//	No status = live
			else
			{
				$oldStatus.val('live');
				status = 'live';
			}

		//	Ajaxify forms
			$.ajax(
			{
				url: $form.attr('action'),
				type: $form.attr('method'),
				data: $form.serialize(),
				success: function(result)
				{
				//	DEBUG
					console.log(result);
				//	Ajax sends back the id
					if ($.isNumeric(result))
					{
					//	Bring it to the form
						id.val(result);
					};
				//	Callback
					if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) callback.call(this, result);
				},
			});
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.greenbutton = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('greenbutton'))
			{
				var plugin = new $.greenbutton(this, options);
				$(this).data('greenbutton', plugin);
			}
		});
	}
})(jQuery);