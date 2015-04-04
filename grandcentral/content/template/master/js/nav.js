/*********************************************************************************************
/**	* Display info about the service
 	* @author	@mvdandrieux
**#******************************************************************************************/
(function($)
{
	$('#nav').click(function(e)
	{
		if( e.target == this )  $('#main').removeClass('poppedNav');
	});
})(jQuery);
