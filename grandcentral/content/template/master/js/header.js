/*********************************************************************************************
/**	* Use H1 as navigation
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{
//	Some vars
	var h1 = 'header h1';
	var i = $(h1).find('i');
	var iClass = i.attr('class');
//	Over & out
	$(document).on('mouseover', h1, function()
	{
		i.attr('class', '').addClass('icon-arrow-left');
	});
	$(document).on('mouseout', h1, function()
	{
		i.attr('class', '').addClass(iClass);
	});
})(jQuery);