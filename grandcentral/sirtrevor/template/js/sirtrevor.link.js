(function($)
{
//	External link
	$(document).on('click', '#adminContext [data-template="sirtrevor.link"] .external button.done', function()
	{
	//	Get the value from the iframe
		link = $('#externalLink').contents().find('input').val();
		
	//	Good link
		if(link && link.length > 0)
		{
			link_regex = /(ftp|http|https):\/\/./;
			if (!link_regex.test(link)) link = "http://" + link;
			document.execCommand('CreateLink', false, link);
			closeContext();
		}
	//	Bad link
		else console.log('That is not a valid URL, buddy');
	});
	
//	Internal link
	$(document).on('click', '#adminContext [data-template="sirtrevor.link"] .internal [data-item] button', function()
	{
		link = $(this).parent().data('item');
		document.execCommand('CreateLink', false, link);
		closeContext();
	});
	
//	Refine item lists
	$('#adminContext [data-template="sirtrevor.link"] .internal input[type="search"]').each(function()
	{
	//	Some vars
		$input = $(this);
		item = $input.data('item');
		$target = $(this).next('ul');
	//	Search as you type
		$input.searchasyoutype(
		{
			app:'field',
			template:'sirtrevor.link.internal',
			param:'{"item":"'+item+'"}',
			target:$target,
		})
	//	Start with something
		.trigger('input');
	});
})(jQuery); 