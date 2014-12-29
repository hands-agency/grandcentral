/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).ready(function ()
{	
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
		//	console.log(response);
		//	console.log(response.code);
		//	console.log(response.data);
			
		//	What should i do know?
			switch(response.code)
			{
			//	OK
				case 'success':
				//	Show your face
					$('#profilepic').attr('style', 'background-image:url('+response.data.profilepic+')');
					setTimeout(function()
					{
					//	Go! go! go!
						window.location = document.URL;	
					}, 200)
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