(function($)
{
//	Some vars
	template = '/field/link';
	
//	External link
	$(document).on('click', '.adminContext[data-template="'.template.'"] .external button.done', function()
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
	
//	Internal link
	$(document).on('click', '.adminContext[data-template="'.template.'"] .internal [data-item] button', function()
	{
		link = $(this).parent().data('item');
		document.execCommand('CreateLink', false, link);
		closeContext(template);
	});
	
//	Refine item lists
	$('.adminContext[data-template="'.template.'"] .internal input[type="search"]').each(function()
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
})(jQuery); 