/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).ready(function ()
{
//	Ouvrir grand la nav
	hideNav();
	
//	When submitting
	$('form').on('submit', function(e)
	{
	//	Prevent POST
		e.preventDefault();
	//	Some vars
		var form = $(this);
		$.post(form.attr('action'), form.serialize(), function(response)
		{
		//	DEBUG
			console.log(response);
			
		//	What should i do know?
			switch(response)
			{
			//	OK
				case 'success':
					window.location = document.URL;
					break;
			//	KO
				case 'fail':
				//	And shake your head to say No, No, No...
					form.effect('shake', { times:3 }, 300);
					break;
			}
		});
	});
});
