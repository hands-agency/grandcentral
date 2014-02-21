/*********************************************************************************************
/**	* Form validation plugin
 	* @author	mvd@cafecentral.fr
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
			$('.tabs li').click(function()
			{
			//	Some vars
				link = $(this).find('a');
				section = link.data('section');
			//	The different choices
				dflt = $('#section_'+section).data('greenbutton');

			//	If you have choices
				if (dflt)
				{
					$('#greenbutton-default')
						.html(dflt['title'])
						.data('action', dflt['key']);
				}
			//	No choices
			//	else $('#greenbutton').hide();
				else console.log('No choices for green button, not good');
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
				sectionid = $('#content section:visible').attr('id').replace('section_', '');
			//	Open the context
				openContext(
				{
					app:'content',
					template:'master/snippet/greenbutton/greenbutton.context',
					sectionid:sectionid,
				});
			});

		//	A click a button triggers a method
			$(document).on('click', '#greenbutton-default, #greenbutton-choices a', function()
			{
				method = $(this).data('action');
			//	Create & execute the method
				var fn = plugin[method];
				fn();
			});
			
		//	Prevent regular submit
			$('#content>section').on('submit', 'form', function()
			{
				return false;
			});
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
		//	Trigger regular submit for eventual plugin callbacks
			$('#content>section>form').submit();
			
		//	Id & status
			id = $('input[name="'+SITE_KEY+'_'+_GET['item']+'[id]"]');
			oldStatus = $('input[name="'+SITE_KEY+'_'+_GET['item']+'[status]"]');
			form = $('#content>section>form');
			
		//	Change status ?
			if (newStatus) oldStatus.val(newStatus);

		//	Ajaxify forms
			$.ajax(
			{
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				success: function(result)
				{
				//	DEBUG
					console.log(result);
				//	Ajax sends back the id
					if ($.isNumeric(result))
					{
					//	Bring it to the form
						id.val(result);
						$('#greenbutton-default').removeClass('on');
					//	Rewrite URL
						url = '?item='+_GET['item']+'&id='+result;
						if (window.location.hash) url += window.location.hash;
						window.history.pushState('string', 'chose', url);
					//	Callback	
						if ((typeof(callback) != 'undefined') && (typeof(callback) == "function")) callback.call(this, result);
					};
				},
			});
		}

	//	Go live
		plugin.live = function(callback)
		{
		//	Validate before go live
			$('#section_edit form').data('validate').now(
			{
				success:function(html)
				{
				//	Submit all forms	
					plugin.save('live', callback);
				},
				error:function()
				{
				//	console.log('error');
				},
				complete:function()
				{
				//	console.log('complete');
				},
			});
		}

	//	Asleep
		plugin.asleep = function()
		{
		//	Submit all forms	
			plugin.save('asleep');
		}

	//	Save a copy
		plugin.save_copy = function()
		{
		//	Get rid of id and save
			$('input[name="'+SITE_KEY+'_'+_GET['item']+'[id]"]').val('');
			plugin.save();
		}

	//	Save and start anew
		plugin.save_new = function()
		{
			plugin.live(function()
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

	//	Preview
		plugin.preview = function()
		{
			plugin.save('draft', function()
			{
				openSite();
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
			document.location.href = ADMIN_URL+'/edit?item=page';
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