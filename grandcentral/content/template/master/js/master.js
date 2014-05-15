/*********************************************************************************************
/**	* Café Central ajax call (everything goes in POST)
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	(function( $ )
	{
		$.ajx = function(param, callback, option)
		{
		//	Don't print the return
			if (!option) option = Array;
			option['print'] = false;
			if (!option['mime']) option['mime'] = 'json';
			$.fn.ajx(param, callback, option);
		}

		$.fn.ajx = function(param, callback, option)
		{
		//	Option
			if (!option) option = Array;
			debug = option['debug'] || false
			async = option['async'] || true;
			print = option['print'] || true;
			mime = option['mime'] || 'html';
			if (!callback) callback = Array;
		
		//	Params
			var url = ADMIN_URL+'/ajax.'+mime;
		//	Reroute the _GET (currently declared in the master)
			param['_GET'] = _GET;
		//	Pass DEBUG via post
			if (debug === true) param['DEBUG'] = 'true';

		//	Call
			$.ajax(
			{
				type:'POST',
				url:url,
				async:async,
				context:this,
				data:param,
			})
			.done(function(html)
			{
			//	Return HTML
			/* bug : option is global and must be reset !*/
				if (print === true) $(this).html(html);
			//	Execute callback (make sure the callback is a function)
				if ((typeof(callback) != 'undefined') && (typeof(callback['done']) == "function")) callback['done'].call(this, html);
				
			})
			.fail(function( jqXHR, textStatus )
			{
			//	console.log( "Request failed: " + textStatus );
				console.log( "Request failed: " + jqXHR.responseText );
			});
		};
	})( jQuery );

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
		item = $(this).parents('li[data-item]');
		notes = item.find('div.notes').first();

	//	First timer: fill up and show
		if (notes.is(':empty'))
		{
		//	Load the notes drop
			notes.ajx(
			{
				app:'section',
				template:'notes',
				displayNotes:5,
				item:item.data('item'),
			},{
				done:function()
				{
				//	Show the notes
					notes.show('fast');
				}
			});
		}
	//	Already loaded: toggle
		else notes.toggle('fast');
		
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
			$loading = $(this).find('.loading');
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
	openContext = function(param)
	{
		$('#main').removeClass('contextClosed').addClass('contextOpened');
		$('#adminContext>div').attr('data-template', param.template).ajx(param);
		/* TODO Hacky way to recenter the panel */
		setTimeout(function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		}, 220);

		
	}
	closeContext = function()
	{
		$('#main').removeClass('contextOpened').addClass('contextClosed');
		$('#adminContext>div').attr('data-template', '').html('');
		/* TODO Hacky way to recenter the panel */
		setTimeout(function()
		{
			$('#tabs li a'+pseudo).parent().trigger('click');
		}, 220);
	}
	
//	Site
	openSite = function(url)
	{
		$('#main').addClass('siteOpened');
		if (url) $('#grandCentralSite').find('iframe').attr('src', url);
	//	window.history.pushState('string', 'chose', '/');
	}
	
//	alert
	popAlert = function(type, label)
	{
		$('#main').addClass('poppedAlert').delay(1000).queue(function(){$(this).removeClass('poppedAlert').dequeue();});
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