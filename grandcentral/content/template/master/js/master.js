/*********************************************************************************************
/**	* Grand Central ajax call (everything goes in POST, but current GET is rerooted)
 	* @author	@mvdandrieux
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
			
		//	Reroute the _GET otherwise overriden (currently declared in the master)
			if (typeof(plugin.settings['_GET']) == 'undefined') plugin.settings['_GET'] = _GET;

		//	Call
			$.ajax(
			{
				type:'POST',
				url:url,
				async:async,
				context:this,
				data:plugin.settings,
			})
			.done(function(result)
			{
			//	Return HTML
				if ($element.length) $element.html(result);
			//	Move <script> and <link> up to the header
				$element.find('script, link').appendTo('head');
			//	Execute callback (make sure the callback is a function)
				if ((typeof(callbacks) != 'undefined') && (typeof(callbacks['done']) == "function")) callbacks['done'].call($element, result);	
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
/**	* Grand Central api call (everything goes in POST, but current GET is rerooted)
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.api = function(options, callbacks, element)
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
			method = (typeof(plugin.settings.method) != 'undefined') ? plugin.settings.method : console.warn('You need a Request Method like "get" or "post"');
			url = (typeof(plugin.settings.url) != 'undefined') ? ADMIN_URL+'/'+plugin.settings.url : console.warn('You need an url like "api.json/item/page"');
			async = (typeof(plugin.settings.async) != 'undefined') ? plugin.settings.async : true;

		//	Call
			$.ajax(
			{
				type:method,
				url:url,
				async:async,
				context:this,
				data:plugin.settings.data,
			})
			.done(function(result)
			{
			//	Execute callback (make sure the callback is a function)
				if ((typeof(callbacks) != 'undefined') && (typeof(callbacks['done']) == "function")) callbacks['done'].call($element, result);	
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
	$.fn.api = function(options, callbacks)
	{
		return this.each(function()
		{
		//	if (undefined == $(this).data('api'))
		//	{
				var plugin = new $.api(options, callbacks, this);
				$(this).data('api', plugin);
		//	}
		});
	}
})(jQuery);

/*********************************************************************************************
/**	* Open notes from the action list
 	* @author	@mvdandrieux
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
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#grandCentralAdmin').on('click', '.adminContext>button.close', function()
	{
		template = $(this).parent('.adminContext').data('template');
		closeContext(template);
	});
	$('#switchEnv').on('click', function()
	{
		openSite(CURRENTEDITED_URL);
	});
	
	
	
/*********************************************************************************************
/**	* All links
 	* @author	@mvdandrieux
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
 	* @author	@mvdandrieux
**#******************************************************************************************/
/*
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
/**	* Confort loading
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
	//	Here we go!
	$.loading = function(callback, element)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
		spinner = '<div	class="loadingbox"><svg class="spinner" width="50px" height="50px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="1" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>';
		$element.html('').append(spinner);
		
	//	Execute callback (make sure the callback is a function)
		if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) callback.call($element);
	}

//	Add the plugin to the jQuery.fn object
	$.fn.loading = function(callback)
	{
		return this.each(function()
		{
		//	if (undefined == $(this).data('loading'))
		//	{
				var plugin = new $.loading(callback, this);
				$(this).data('loading', plugin);
		//	}
		});
	}
})( jQuery );
	
/*********************************************************************************************
/**	* Opening and closing Lanes
 	* @author	@mvdandrieux
**#******************************************************************************************/
//	Context
	openContext = function(param, callback)
	{
	//	Some vars
		maxContext = 2;
		
	//	If context already exists, refresh it
		if ($('.adminContext[data-template="'+param.template+'"]').length > 0)
		{
			context = $('.adminContext[data-template="'+param.template+'"]');
		}
	//	Other wise, append a new Context area
		else
		{
			adminContext = '<aside class="adminContext"><button type="button" class="close"></button><div><!-- Welcome Ajax --></div></aside>';
			context = $(adminContext).appendTo('#grandCentralAdmin');
		}
		
	//	Resize Content & Context
		countContext = $('#grandCentralAdmin').find('.adminContext').length;
		$('#main').addClass('contextOpened'+countContext);
	
	//	Load
		$(context).attr('data-template', param.template).find('> div').ajx(
			param,
			{
				done:function()
				{					
				//	Callback
					if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) callback.call(this);
				}
			}
		);
		
	//	Recenter the panel after transition
		$('#adminContent').one('transitionend', function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		});
	}
	closeContext = function(template)
	{
	//	Resize
		countContext = $('#grandCentralAdmin').find('.adminContext').length;
		$('#main').removeClass('contextOpened'+countContext);
		
	//	Kill
		$('.adminContext[data-template="'+template+'"]').remove();
		
	//	Recenter the panel after transition
		$('#adminContent').one('transitionend', function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		});
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
		
		if ($('#main').hasClass('siteOpened') === false)
		{
		//	Open at the right page
			$('#main').addClass('siteOpened');
			if (url && $iframe.is(':empty')) $iframe.attr('src', url);
		
			$('#grandCentralSite').height($(window).height());
		
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
		else
		{
			$('#main').removeClass('siteOpened');
			$('#grandCentralSite').height('0');
		}
	}
	
//	Alert
	popAlert = function(type, label, callback)
	{
		$('#main').addClass('poppedAlert').delay(1000).queue(function()
		{
			$(this).removeClass('poppedAlert').dequeue();
		//	Callback
			if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) callback.call(this);
		});
	//	Give type and label
		$('#alert').attr('class', type);
		$('#alert .response').html(label);
	}
	$(document).on('click', '#alert', function()
	{
		$('#main').removeClass('poppedAlert');
	});

/*********************************************************************************************
/**	* Nav
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '#openNav', function()
	{
	//	Some vars
		$nav = $('#nav');
		$('#main').addClass('poppedNav');
		
	//	Load nav just once
		if ($nav.is(':empty'))
		{
			$nav.loading();
			$nav.ajx(
			{
				app:'content',
				template:'/master/nav',
			//	sectiontype:$('#adminContent section.active').data('template'),
			},{
				done:function()
				{
				}
			});
		}
		
	});
	$(document).on('click', '#closeNav', function()
	{
		$('#main').removeClass('poppedNav');
	});

/*********************************************************************************************
/**	* Make the bubbles with the .warn class jump
 	* @author	@mvdandrieux
**#******************************************************************************************/
/*	$('.cc-bubble .remindme').effect('bounce', {distance:'10', times:'2'}, 250); */