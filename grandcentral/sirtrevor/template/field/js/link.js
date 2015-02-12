(function($)
{
//	Some vars
	template = '/field/link';
	
//	Tabs
	$(document).on('mousedown', '.adminContext .tabs li', function()
	{
	//	Some vars
		$admincontext = $(this).parents('.adminContext');
		$tabs = $admincontext.find('.tabs');
		$panels = $admincontext.find('.panels');
		currentTab = $(this).data('tab');
		
	//	Close all tabs & panels
		$tabs.find('>li').attr('class', 'off');
		$panels.find('>div').attr('class', 'off');
		
	//	Open the right one
		$tabs.find('>li[data-tab="'+currentTab+'"]').attr('class', 'on');
		$panel = $panels.find('>div[data-panel="'+currentTab+'"]');
		$panel.attr('class', 'on');
		
	//	Init the panel (cameltoe function initCurrenttab)
		function_name = 'init'+currentTab.charAt(0).toUpperCase() + currentTab.slice(1);
		window[function_name]($panel);	
	});
	
//	Init internal linking
	initInternal = function(panel)
	{
	//	Send Internal link
		$(document).on('click', '.adminContext[data-template="/field/link"] .internal [data-item] button', function()
		{
			link = $(this).parent().data('item');
			document.execCommand('CreateLink', false, link);
			closeContext(template);
		});
	
	//	Refine item lists
		$('.adminContext[data-template="/field/link"] .internal input[type="search"]').each(function()
		{
		//	Some vars
			$input = $(this);
			item = $input.data('item');
			$target = $(this).next('ul');
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
		$(document).on('click', '.adminContext[data-template="/field/link"] .external button.done', function()
		{
		//	Get the value from the iframe
			link = $('#externalLink').contents().find('input').val();
		
		//	Good link
			if(link && link.length > 0)
			{
				link_regex = /(ftp|http|https):\/\/./;
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
					console.log(url);
				//	Send link
					document.execCommand('CreateLink', false, url);
					closeContext(template);
				});
			}
		});
		
	}
	
})(jQuery); 