/*********************************************************************************************
/**	* Load labs
* @author	@mvdandrieux
**#******************************************************************************************/
	$('section[data-template="/lab"]').on('click', 'ul#labToc li a', function()
	{
		$lab = $(this);
		$panel = $('section.active');
		
	//	Fetch content
		$panel
			.addClass('loading')
			.ajx(
			{
				app:'lab',
				template:$lab.attr('href'),
			}, {
			//	Done
				done:function()
				{
				//	Say it's loaded
					$panel.removeClass('loading');
				}
			});
		
		return false;
	});