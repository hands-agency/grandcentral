/*********************************************************************************************
/**	* Display info about the service
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
	$('#nav').click(function(e)
	{
		if( e.target == this )  $('#main').removeClass('poppedNav');
	});
})(jQuery);
