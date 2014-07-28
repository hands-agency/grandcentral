/*********************************************************************************************
/**	* Grand Central ajax call (everything goes in POST, but current GET is rerooted)
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.ajx = function(options, callbacks, element)
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
			
		//	Some vars
			mime = (typeof(plugin.settings.mime) != 'undefined') ? plugin.settings.mime : 'html';
			async = (typeof(plugin.settings.async) != 'undefined') ? plugin.settings.async : true;
			url = ADMIN_URL+'/ajax.'+mime;
			
		//	Reroute the _GET (currently declared in the master)
			plugin.settings['_GET'] = _GET;

		//	Call
			$.ajax(
			{
				type:'POST',
				url:url,
				async:async,
				context:this,
				data:plugin.settings,
			})
			.done(function(html)
			{
			//	Return HTML
				if ($element.length) $element.html(html);
			//	Execute callback (make sure the callback is a function)
				if ((typeof(callbacks) != 'undefined') && (typeof(callbacks['done']) == "function")) callbacks['done'].call($element, html);	
			})
			.fail(function( jqXHR, textStatus )
			{
			//	console.log( "Request failed: " + textStatus );
				console.log( "Request failed: " + jqXHR.responseText );
			});
			
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.ajx = function(options, callbacks)
	{
		return this.each(function()
		{
		//	if (undefined == $(this).data('ajx'))
		//	{
				var plugin = new $.ajx(options, callbacks, this);
				$(this).data('ajx', plugin);
		//	}
		});
	}
})(jQuery);

/*********************************************************************************************
/**	* Close all the shy elements when clicking outside
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).click(function(e)
	{
		$('.shy').hide('fast');
	});
	

/*********************************************************************************************
/**	* Open notes from the action list
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', 'ul.action a.notes', function(event)
	{
	//	Some vars
		$item = $(this).parents('li[data-item]');
		$notes = $item.find('div.notes').first();

	//	First timer: fill up and show
		if ($notes.is(':empty'))
		{
		//	Load the notes drop
			$notes.ajx(
			{
				app:'content',
				template:'/notes/notes',
				displayNotes:5,
				item:$item.data('item'),
			},{
				done:function()
				{
				//	Show the notes
					$notes.show('fast');
				}
			});
		}
	//	Already loaded: toggle
		else $notes.toggle('fast');
		
	//	Focus
	//	notes.find('textarea').focus();
	
	//	Prevent link
		return false;
	});
	
	
/*********************************************************************************************
/**	* Open / close lanes
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('#grandCentralAdmin>#adminContent>button.close').on('click', function()
	{
		closeAdmin();
	});
	$('#grandCentralAdmin>#adminContext>button.close').on('click', function()
	{
		closeContext();
	});
	$('#grandCentralSite>.overlay').on('click', function()
	{
		openSite();
	});
	
	
	
/*********************************************************************************************
/**	* All links
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '[data-item-link]', function()
	{
		nickname = $(this).data('item').split('_');
		item = nickname[0];
		id = nickname[1];
		tab = $(this).data('item-link');
	//	Go there
		url = ADMIN_URL+'/edit?item='+item+'&id='+id+'#'+tab;
		document.location.href = url;
	});
	
/*********************************************************************************************
/**	* Load the site
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	(function($)
	{
		document.onreadystatechange = function()
		{
		    if (document.readyState === 'complete') 
			{
				$('#grandCentralSite').append('<iframe src="'+CURRENTEDITED_URL+'"></iframe>');
				
				$('#grandCentralSite iframe').load(function()
				{
					currentTitle = $(this).contents().find('meta[property="gc:title"]').html();
					if (currentTitle) $('#siteNav .edit').html('Edit '+currentTitle+'');
				});
			}
		}
	})( jQuery );
	
/*********************************************************************************************
/**	* Create a loading
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	(function($)
	{
		var animate;
		
		$.fn.loading = function()
		{
		//	HTML
			$loading = $('<div class="loading" style="display:none"><progress value="00" max="100"></progress></div>').appendTo($(this)).slideDown('fast');

		//	Some vars
			var progressbar = $loading.find('progress'),
			max = progressbar.attr('max'),  
			time = (1000/max)*2,      
			value = progressbar.val();

			var loading = function()
			{
				value += 1;  
				addValue = progressbar.val(value);  
				if (value == max) {  
					clearInterval(animate);                  
				}  
			};  
			var animate = setInterval(function()
			{
				loading();  
			}, time);
		};
		
		$.fn.loaded = function()
		{
		//	Get the element with only the loading class
			$loading = $(this).find('>[class="loading"]');
		//	$loading.find('progress').val(100);
			$loading.hide('fast', function(){$(this).remove()});
		};
	})( jQuery );
	
/*********************************************************************************************
/**	* Opening and closing Lanes
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	Nav
	openNav = function()
	{
		$('#main').removeClass('navClosed').addClass('navOpened');
	}
	closeNav = function()
	{
		$('#main').removeClass('navOpened').addClass('navClosed');
	}

//	Admin
	openAdmin = function()
	{
		$('#main').removeClass('adminClosed').addClass('adminOpened');
	}
	closeAdmin = function()
	{
		$('#main').removeClass('adminOpened').addClass('adminClosed');
	}

//	Context
	openContext = function(param, callback)
	{
		$('#main').removeClass('contextClosed').addClass('contextOpened');
		$('#adminContext>div').attr('data-template', param.template).ajx(
			param,
			{
				done:function()
				{					
				//	Callback
					if ((typeof(callback) != 'undefined') && (typeof(callback) == "function")) callback.call(this);
				}
			}
		);
		/* TODO Hacky way to recenter the panel */
		setTimeout(function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		}, 300);
	}
	closeContext = function()
	{
		$('#main').removeClass('contextOpened').addClass('contextClosed');
		$('#adminContext>div').attr('data-template', '').html('');
		/* TODO Hacky way to recenter the panel */
		setTimeout(function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		}, 300);
	}
	
//	Site
	openSite = function(url)
	{
	//	Some vars
		$siteNav = $('#siteNav');
		$iframe = $('#grandCentralSite iframe');
		
		$sitetree = $siteNav.find('.sitetree');
		$edit = $siteNav.find('.edit');
		$admin = $siteNav.find('.admin');
		
	//	Open at the right page
		$('#main').addClass('siteOpened');
		if (url) $iframe.attr('src', url);
		
	//	sitetree
		$sitetree.on('click', function()
		{
		//	Go to edit page
			document.location.href = ADMIN_URL+'/list?item=page';
		});
		
	//	Edit
		$edit.on('click', function()
		{			
			nickname = $iframe.contents().find('meta[property="gc:item"]').attr('content');
			item = nickname.split('_')[0];
			id = nickname.split('_')[1];
		//	Go to edit page
			document.location.href = ADMIN_URL+'/edit?item='+item+'&id='+id;
		});
		
	//	Back to admin
		$admin.on('click', function()
		{
			$('html, body').animate({
       			 scrollTop: 150
			    }, 300);
		});
		
	//	Update edit button
	//	window.history.pushState('string', 'chose', '/');
	}
	
//	Alert
	popAlert = function(type, label, callback)
	{
		$('#main').addClass('poppedAlert').delay(1000).queue(function()
		{
			$(this).removeClass('poppedAlert').dequeue();
		//	Callback
			if ((typeof(callback) != 'undefined') && (typeof(callback) == "function")) callback.call(this);
		});
		$('#alert').attr('class', type);
		$('#alert .response').html(label);
	}
	$(document).on('click', '#alert', function()
	{
		$('#main').removeClass('poppedAlert');
	});

/*********************************************************************************************
/**	* Make the bubbles with the .warn class jump
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
/*	$('.cc-bubble .remindme').effect('bounce', {distance:'10', times:'2'}, 250); */