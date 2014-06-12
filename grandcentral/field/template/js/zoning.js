$(document).ready(function ()
{
/*********************************************************************************************
/**	* Multiple
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"]').multipleselect(
	{		
		app:"field",
		template:"/zoning.available"
	});

/*********************************************************************************************
/**	* Popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('[data-type="zoning"] .zone .title').on('click', function()
	{
		openContext(
		{
			app: 'field',
			template: '/app.context',
		});
		return false;
	});
});