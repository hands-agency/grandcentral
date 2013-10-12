/*********************************************************************************************
/**	* Move to an app
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}})(jQuery);

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
			option['mime'] = 'json';
			$.fn.ajx(param, callback, option);
		}

		$.fn.ajx = function(param, callback, option)
		{
		//	Option
			if (!option) option = Array;
			debug = option['debug'] || false;
			async = option['async'] || true;
			print = option['print'] || true;
			mime = option['mime'] || 'html';
			if (!callback) callback = Array;
		
		//	Params
			var url = ADMIN_URL+'/api.'+mime;
		//	Add the current item
			param['caller_item'] = ITEM;
			param['caller_id'] = ID;
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
				if (typeof callback['done'] == 'function')
				{
					callback['done'].call(this); // brings the scope to the callback
				}
				
			})
			.fail(function( jqXHR, textStatus )
			{
				console.log( "Request failed: " + textStatus );
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
	$('#grandCentralAdmin>button.close').on('click', function()
	{
		$('#main').removeClass('adminOpened').addClass('adminClosed');
	});
	$('#grandCentralSite>.overlay').on('click', function()
	{
		$('#main').removeClass('adminOpened').addClass('adminClosed').removeClass('navOpened').addClass('navClosed');
	});
	
	$('#grandCentralSite').on('click', function()
	{
		
	});
	$('#grandCentralSite').append('<iframe src="'+SITE_URL+'"></iframe>');
	
/*********************************************************************************************
/**	* Make the bubbles with the .warn class jump
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	(function($)
	{
		$.fn.loading = function()
		{
			
			var progressbar = $(this),
			max = progressbar.attr('max'),  
			time = (1000/max)*2,      
			value = progressbar.val();  

			var loading = function()
			{
				value += 1;  
				addValue = progressbar.val(value);  
				$('.progress-value').html(value + '%');  
				if (value == max) {  
					clearInterval(animate);                      
				}  
			};  
			var animate = setInterval(function()
			{
				loading();  
			}, time);
		};
	})( jQuery );
	
/*********************************************************************************************
/**	* Resize the main view to fit viewport
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	resize = function()
	{
		$('#main').height($(window).height());
	}
//	Resize now
	resize();
//	And when the window resizes
	$(window).resize(function(){resize()});

/*********************************************************************************************
/**	* Make the bubbles with the .warn class jump
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
/*	$('.cc-bubble .remindme').effect('bounce', {distance:'10', times:'2'}, 250); */