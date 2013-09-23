/*********************************************************************************************
/**	* Compare updates
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('ul.action a.compare').on('click', function()
	{
		$(this).popup(
		{
			app:'media',
			theme:'admin',
			template:'admin',
			width:'300px',
		});
		return false;
	});