$(document).ready(function()
{			
/*********************************************************************************************
/**	* Add a new action to the greenbutton
* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('blur', '[name="app[cover]"]', function()
	{
		$('section header .cover').css('background-image', 'url("'+$(this).val()+'")');
	});
			
/*********************************************************************************************
/**	* Add a new action to the greenbutton
* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').add(
	{
		title:
		{
			en:'Build',
			fr:'Construire'
		},
		key:'build',
	});

/*********************************************************************************************
/**	* Define the build method 
* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').build = function()
	{
	//	Some vars
		$form = $('#adminContent section form');
	
	//	Validate forms before building
		$('section form').data('validate').now(
		{
			success:function(html)
			{
			//	Ajaxify forms
				$.ajax(
				{
					url: $form.attr('action'),
					type: $form.attr('method'),
					data: $form.serialize(),
				})
				.done(function(result)
				{
				//	DEBUG
					console.log(result);
	
				//	Some vars
					meta = result.meta;
					data = result.data;

				//	Alert
					popAlert(meta.status, meta.status, function()
					{
					//	Go to the list page
						document.location.href = ADMIN_URL+'/app?app='+data.key;
					});
				})
				.fail(function( jqXHR, textStatus )
				{
				//	console.log( "Request failed: " + textStatus );
					console.log( "Request failed: " + jqXHR.responseText );
				});
			},
			error:function()
			{			
			//	Pop alert
				popAlert('error', 'Couple of things missing.');
			//	console.log('error');
			},
			complete:function()
			{
			//	console.log('complete');
			},
		});
	}

/*********************************************************************************************
/**	* Handling key and title binding
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('section [name$="[title]"]').on('input', function()
	{
		key = $(this).val().replace(' ', '').toLowerCase();
		change = $('section [name$="[key]"]');
		change.val(key);
	});
});