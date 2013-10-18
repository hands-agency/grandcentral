/*********************************************************************************************
/**	* Tabs : Open and close content via tabs
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).ready(function ()
{
	broadenNav();

//	Resize and zoom out iframes
//	$('iframe').addClass('zoomout');
	
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
			
		//	What should i do know?
			switch(response)
			{
			//	OK
				case 'ok':
				//	Load content of admin
					$('iframe#admin').attr('src', $('iframe#admin').data('src'));
				//	Move iframes
					$('iframe')
						.addClass('final')
						.delay('900')
						.queue(function()
						{
							$('iframe').removeClass('zoomout');
							$('#content, #popup_overlay').fadeOut('fast');
						//	Rewrite URL
							window.history.pushState('string', 'Admin', ADMIN_URL);
						});
					break;
			//	KO
				case 'ko':	
				//	And shake your head to say No, No, No...
					form.effect('shake', { times:3 }, 300);
					break;
			}
		});
	});
});
