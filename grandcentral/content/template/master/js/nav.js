(function($)
{
/*********************************************************************************************
/**	* Close the overlay on click out
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#nav').click(function(e)
	{
		if( e.target == this )  $('#main').removeClass('poppedNav');
	});
	
/*********************************************************************************************
/**	* Open the media library
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#nav').on('click', 'a.media', function()
	{
	//	Close nav
		$('#main').removeClass('poppedNav');
	//	Launch
		openContext(
		{
			app:'media',
			template:'admin',
		});
	});
})(jQuery);
