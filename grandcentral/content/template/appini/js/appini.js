/*********************************************************************************************
/**	* Load Templates
* @author	@mvdandrieux
**#******************************************************************************************/
	$('section[data-template="/appini/appini"]').on('click', 'ul.templates li a', function()
	{
		$template = $(this);
		$panel = $('section.active');
		
	//	Fetch content
		$panel
			.addClass('loading')
			.ajx(
			{
				app:$template.data('app'),
				template:$template.data('template'),
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