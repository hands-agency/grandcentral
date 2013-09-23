/*********************************************************************************************
/**	* Compare updates
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '#eventstream a.compare', function()
	{
		
		$(this).popup({
			app:'media',
			theme:'admin',
			template:'admin',
			width:'300px',
		});
		return false;
	});
