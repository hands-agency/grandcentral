(function($)
{
//	Some vars
	var template = '/field/link';
	
//	Tabs
	$(document).on('click', '.adminContext .tabs li', function()
	{
	//	Some vars
		var $admincontext = $(this).parents('.adminContext');
		var $tabs = $admincontext.find('.tabs');
		var $panels = $admincontext.find('.panels');
		var currentTab = $(this).data('tab');
		
	//	Close all tabs & panels
		$tabs.find('>li').attr('class', 'off');
		$panels.find('>div').attr('class', 'off');
		
	//	Open the right one
		$tabs.find('>li[data-tab="'+currentTab+'"]').attr('class', 'on');
		$panel = $panels.find('>div[data-panel="'+currentTab+'"]');
		$panel.attr('class', 'on');
		
	//	Init the panel (cameltoe function initCurrenttab)
		var function_name = 'init'+currentTab.charAt(0).toUpperCase() + currentTab.slice(1);
		window[function_name]($panel);	
	});
	
//	Init internal linking
	initInternal = function(panel)
	{
		
		// restore selection when blur input
		$('.adminContext').on('blur', 'input[type="search"]', function()
		{
			restoreSelection(selRange);
			// selRange = false;
		});
	//	Send Internal link
		$(document).on('click', '.adminContext[data-template="/field/link"] [data-panel="internal"] [data-item] button', function(e)
		{
			if (selRange !== null)
			{
				restoreSelection(selRange);
				var link = $(this).parent().data('item');
				// console.log(link)
				document.execCommand('CreateLink', false, link);
				closeContext(template);
				selRange = null;
			};
		});
	//	Refine item lists
		$('.adminContext[data-template="/field/link"] [data-panel="internal"] input[type="search"]').each(function()
		{
		//	Some vars
			var $input = $(this);
			var item = $input.data('item');
			var $target = $(this).next('ul');
		//	Search as you type
			$input.searchasyoutype(
			{
				app:'sirtrevor',
				template:'/field/link.internal',
				param:'{"item":"'+item+'"}',
				target:$target,
			})
		//	Start with something
			.trigger('input');
		});
	}
	
//	Init external linking
	initExternal = function(panel)
	{
		
	//	Send external link
		$(document).on('click', '.adminContext[data-template="/field/link"] [data-panel="external"] button.done', function()
		{
		//	Get the value from the iframe
			var link = $(this).parent().find('iframe').contents().find('input').val();
		
		//	Good link
			if(link && link.length > 0)
			{
				var link_regex = /(ftp|http|https):\/\/./;
				if (!link_regex.test(link)) link = "http://" + link;
				document.execCommand('CreateLink', false, link);
				closeContext(template);
			}
		//	Bad link
			else console.log('That is not a valid URL, buddy');
		});
	}
	
//	Init media linking
	initMedia = function(panel)
	{
		panel.ajx(
		{
			app:'media',
			template:'admin',
		}, {
			done:function()
			{
			//	Override "Edit a media"...
				$('#mediaLibrary').off('click', 'a.file');
			//	...with "send the link"
				$(document).on('click', '.adminContext[data-template="/field/link"] #mediaLibrary a.file', function()
				{
					url = $(this).parent().data('url');
				//	Send link
					document.execCommand('CreateLink', false, url);
					closeContext(template);
				});
			}
		});
	}
	
//	Open one by default
	$('.adminContext .tabs li[data-tab="internal"]').trigger('click');
	
})(jQuery); 