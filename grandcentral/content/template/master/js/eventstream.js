/*********************************************************************************************
/**	* Compare updates
* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '#eventstream a.compare', function()
	{
		$(this).popup(
		{
			app:'media',
			template:'admin',
			width:'300px',
		});
		return false;
	});
