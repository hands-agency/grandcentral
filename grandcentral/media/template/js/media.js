/*********************************************************************************************
/**	* Media library
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
	$.fn.ccLibrary = function(options)
	{
		var $ccLibrary = this;
		var optionsdefault =
		{
			'root': '',						//	Root of the Media Library
			'current': '',					//	Start from this dir
			'file': '',						//	A file to handle in the current dir...
			'path': '',						//	... or path to a file
			'tpl_list': 'list.ajax',
			'tpl_detail': 'detail.ajax',
			'back': '⇠',
			'selector' : false
		};
		var params = $.extend(optionsdefault, options);
	
	//	chargement auto de la galerie		
		init();
		
	//	événement sur les répertoires
		$ccLibrary.on('click', 'a.dir', function()
		{
			if (params.current != '')
			{
				params.current = params.current + '/';
			}
			params.current = params.current + $(this).html();
			loadList();
			return false;
		});
		
	//	événement sur le bouton back
		$ccLibrary.on('click', 'a.back', function()
		{
			// console.log('avant' + params.current)
			pos = strrpos(params.current, '/');
			params.current = pos < 0 ? '' : params.current.slice(0, pos);
			// console.log('après' + params.current)
			loadList();
			return false;
		});
		
	//	Click on a media
		$ccLibrary.on('click', 'a.file', function()
		{
			// console.log('avant' + params.current)
			params.file = $(this).find('.title').html();
			// console.log('après' + params.current)
			loadDetail();
			return false;
		});
		
	//	Close detail
		$ccLibrary.on('click', 'button.back', function()
		{
			params.file = '';
			// console.log('après' + params.current)
			loadList();
			return false;
		});
		
	//	Open/close dirs
		$('#mediaLibraryNav').on('click', '.dir button', function()
		{
			$('.dirs').toggle('fast');
		});
		
		function init()
		{
			if (params.path)
			{
				params.file = params.path.substr(strrpos(params.path, '/') + 1);
				params.current = params.path.substr(0, strrpos(params.path, '/') + 1);
			//	console.log(params)
			}
			if (params.file)
			{
			//	à corriger
				loadList();
			}
			else
			{
				loadList();
			}
		}
		
	//	Charger un répertoire
		function loadList()
		{	
		//	Load the library
			$ccLibrary.ajx(
			{
				app: 'media',
				theme: params.theme,
				template: params.tpl_list,
				root: params.root + '/' + params.current
			},{
				done:function()
				{
				//	ajout du bouton de retour
					if (params.current != '')
					{
						$ccLibrary.find('.dirs ul').prepend('<li><a href="#" class="back">' + params.back + '</a></li>')
					}
				//	Init
					initList();
				}
			});
		}

	//	Init a list
		function initList()
		{
		//	Masonry					
			var container = $ccLibrary.find('.files ul');

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
			$ccLibrary.find('.files ul li:not(.upload)').draggable(
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

		//	Slide titles
			$ccLibrary.find('.files li .title').hoverIntent(
			{
			    over: function(){$(this).addClass('sliding')},
			    out: function(){$(this).removeClass('sliding')},
			});
		}
		
	//	Charger un média
		function loadDetail()
		{
			$ccLibrary.find('.files').ajx(
			{
				app: 'media',
				theme: params.theme,
				template: params.tpl_detail,
				root: params.root + '/' + params.current + '/' + params.file
			},{
			//	Done !
				done:function()
				{
				//	Setup callback function
					if (params.onSelect)
					{
						$ccLibrary.on('click', '.media', function()
						{
							file = $(this).find('img').data('file');
							path = $(this).find('img').data('path');
							thumbnail = $(this).find('img').attr('src');
							window[params.onSelect](
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
		
	//	Trouver le répertoire précédent
		function strrpos(haystack, needle)
		{
			pos = (haystack + '').lastIndexOf(needle);
			// console.log(pos);
			return pos >= 0 ? pos : false;
		}

		return this;
	};
})(jQuery);