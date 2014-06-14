/*********************************************************************************************
/**	* Form validation plugin
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Here we go!
	$.mediaGallery = function(element, options)
	{
	//	Use "plugin" to reference the current instance of the object
		var plugin = this;
	//	this will hold the merged default, and user-provided options
		plugin.settings = {}
		var $element = $(element), // reference to the jQuery version of DOM element
		element = element;	// reference to the actual DOM element
		
	//	Plugin's variables
		var vars = {
			'root': '',						//	Root of the Media Library
			'current': '',					//	Start from this dir
			'file': '',						//	A file to handle in the current dir...
			'path': '',						//	... or path to a file
			'tpl_list': 'list.ajax',
			'tpl_detail': 'detail.ajax',
			'back': '⇠',
			'selector' : false
		}

	//	The "constructor"
		plugin.init = function()
		{
		//	the plugin's final properties are the merged default and user-provided options (if any)
			plugin.settings = $.extend({}, vars, options);


		//	???
			if (plugin.settings.path)
			{
				plugin.settings.file = plugin.settings.path.substr(strrpos(plugin.settings.path, '/') + 1);
				plugin.settings.current = plugin.settings.path.substr(0, strrpos(plugin.settings.path, '/') + 1);
			//	console.log(plugin.settings)
			}
			if (plugin.settings.file)
			{
			//	à corriger
				plugin.loadList();
			}
			else
			{
				plugin.loadList();
			}
			
		//	Click on a folder
			$element.on('click', 'a.dir', function()
			{
				if (plugin.settings.current != '')
				{
					plugin.settings.current = plugin.settings.current + '/';
				}
				plugin.settings.current = plugin.settings.current + $(this).html();
				plugin.loadList();
				return false;
			});
		
		//	Click on a media
			$element.on('click', 'a.file', function()
			{
				// console.log('avant' + plugin.settings.current)
				plugin.settings.file = $(this).find('.title').html();
				// console.log('après' + plugin.settings.current)
				plugin.loadDetail();
				return false;
			});
		
		//	Close detail
			$element.on('click', 'button.back', function()
			{
				plugin.settings.file = '';
				// console.log('après' + plugin.settings.current)
				plugin.loadList();
				return false;
			});
		
		//	Click on the back button
			$element.on('click', 'a.back', function()
			{
				// console.log('avant' + plugin.settings.current)
				pos = strrpos(plugin.settings.current, '/');
				plugin.settings.current = pos < 0 ? '' : plugin.settings.current.slice(0, pos);
				// console.log('après' + plugin.settings.current)
				plugin.loadList();
				return false;
			});
		
		//	Open/close dirs
			$('#mediaLibraryNav').on('click', '.dir button', function()
			{
				$('.dirs').toggle('fast');
			});
		}
		
	//	Method
		plugin.loadList = function()
		{
		//	Start loading
			$element.loading();
		//	Load the library
			$element.ajx(
			{
				app: 'media',
				template: plugin.settings.tpl_list,
				root: plugin.settings.root + '/' + plugin.settings.current
			},{
				done:function(html)
				{
				//	ajout du bouton de retour
					if (plugin.settings.current != '')
					{
						$element.find('.dirs ul').prepend('<li><a href="#" class="back">' + plugin.settings.back + '</a></li>')
					}
				//	Init
					plugin.initList();
				//	End loading
					$element.loaded();
				}
			});
		}
		
	//	Method
		plugin.initList = function()
		{
		//	Masonry					
			var container = $element.find('.files:not(.empty) ul');

			container.imagesLoaded(function()
			{
				container.masonry(
				{
					itemSelector : 'li',
  					gutter: 10,
					isAnimated: true
				});
			});

		//	Make li draggable
			$element.find('.files:not(.empty) ul li:not(.upload)').draggable(
			{
				revert: true,
				revertDuration: 100,
				appendTo:'body',
				helper: 'clone',
				start:function()
				{
        			$(this).hide();
				//	Show trashbin
					$('#trashbin').data('trashbin').toggle();
				},
				stop:function()
				{
        			$(this).show();
				//	Hide trashbin
					$('#trashbin').data('trashbin').toggle();
				}
			});
		}
		
	//	Method
		plugin.loadDetail = function()
		{
			$element.find('.files').ajx(
			{
				app: 'media',
				template: plugin.settings.tpl_detail,
				root: plugin.settings.root + '/' + plugin.settings.current + '/' + plugin.settings.file
			},{
			//	Done !
				done:function()
				{
				//	Setup callback function
					if (plugin.settings.onSelect)
					{
						$element.on('click', '.media', function()
						{
							file = $(this).find('img').data('file');
							path = $(this).find('img').data('path');
							thumbnail = $(this).find('img').attr('src');
							window[plugin.settings.onSelect](
							{
								file:file,
								path:path,
								thumbnail:thumbnail,
							});
						})
					}
				}
			});
		}
		
	//	Method
		plugin.strrpos = function(haystack, needle)
		{
			pos = (haystack + '').lastIndexOf(needle);
			// console.log(pos);
			return pos >= 0 ? pos : false;
		}

	//	Fire up the plugin!
		plugin.init();
	}

//	Add the plugin to the jQuery.fn object
	$.fn.mediaGallery = function(options)
	{
		return this.each(function()
		{
			if (undefined == $(this).data('mediaGallery'))
			{
				var plugin = new $.mediaGallery(this, options);
				$(this).data('mediaGallery', plugin);
			}
		});
	}
})(jQuery);