/*********************************************************************************************
/**	* Compare updates
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('ul.action a.compare').on('click', function()
	{
		openContext(
		{
			app:'media',
			template:'admin',
			width:'300px',
		});
		return false;
	});