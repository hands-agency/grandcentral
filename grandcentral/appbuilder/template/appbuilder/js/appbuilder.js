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
	
	//	Ajaxify forms
		$.ajax(
		{
			url: $form.attr('action'),
			type: $form.attr('method'),
			data: $form.serialize(),
			success: function(result)
			{
			//	DEBUG
				console.log(result);
		
			//	Callback
				if ((typeof(callback) != 'undefined') && (typeof(callback) == 'function')) callback.call(this);
			},
		});
	}
});