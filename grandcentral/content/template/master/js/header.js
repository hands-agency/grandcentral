/*********************************************************************************************
/**	* Use H1 as navigation
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{	
//	Prepare for fullsearch
	$('#refine input').on('input', function()
	{
	//	Some vars
		$input = $(this);
		$drawer = $('header .admin .drawer');
		
		if ($input.val())
		{
		//	Open Drawer
			$drawer.removeClass('closed').addClass('opened');
		//	Prompt
			$drawer.ajx(
			{
				app:'content',
				template:'/master/snippet/options.search',
				q:$input.val(),
			},{
				done:function()
				{
				//	Resize the header after
					$drawer.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function()
					{
						height = $('header .admin').outerHeight();
						$('#adminContent').css('padding-top', height+'px');
					});
				}
			});
		}
	//	Close drawer
		else $drawer.removeClass('opened').addClass('closed');
	});
	
	
//	Fullsearch
	$('#refine input').keyup(function(e)
	{
	//	When return key
    	if(e.keyCode == 13)
		{
	   	//	Some vars
			$input = $(this);
			$drawer = $('header .admin .drawer');
		
			if ($input.val())
			{
			//	Open Drawer
				$drawer.removeClass('closed').addClass('opened');
			//	Prompt
				$drawer.ajx(
				{
					app:'content',
					template:'/master/snippet/options.search',
					q:$input.val(),
					search:true,
				},{
					done:function()
					{
					//	Resize the header after
						$drawer.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function()
						{
							height = $('header .admin').outerHeight();
							$('#adminContent').css('padding-top', height+'px');
						});
					}
				});
			}
		//	Close drawer
			else $drawer.removeClass('opened').addClass('closed');
	    }
	});

})(jQuery);