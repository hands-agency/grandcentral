$(document).ready(function()
{			
/*********************************************************************************************
/**	* Add a new action to the greenbutton
* @author	@mvdandrieux
**#******************************************************************************************/
	$('#greenbutton').data('greenbutton').add(
	{
		title:
		{
			en:'Save changes',
			fr:'Sauvegarder'
		},
		key:'save',
	});

/*********************************************************************************************
/**	* Toc
* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', 'ul#toc li a', function()
	{
		$translate = $(this);
		$panel = $('section.active');
		
	//	Fetch content
		$panel
			.addClass('loading')
			.ajx(
			{
				app:'i18n',
				template:'translate/translate',
				item:$translate.data('item'),
			}, {
			//	Done
				done:function()
				{
				//	Say it's loaded
					$panel.removeClass('loading');
				}
			});
		
		return false;
	});
	
/*********************************************************************************************
/**	* A function to check the translation has been made
* @author	@mvdandrieux
**#******************************************************************************************/
	checkTranslation = function(field)
	{
	//	Check if it's translated
		$inputs = field.find('input, textarea');
		
	//	Check if there is at least an empty value
		translate = false;
		$inputs.each(function()
		{
			if ($(this).val() == '') translate = true;
		});
		
		if (translate === true)
		{
			param = {
			//	html:css,
				feathericon:'',
			//	timeout:'400',
				control:'translate',
			}
			showControl(field, param);
		}
	}

/*********************************************************************************************
/**	* 
* @author	@mvdandrieux
**#******************************************************************************************/
//	Some vars
	$form = $('#translate form');
	
	$form.on('blur', 'input, textarea', function()
	{
		checkTranslation($(this).closest('[data-key]'));
	});
	
	$form.each(function()
	{
	//	The fields
		$field = $(this).find('li[data-key]');
		
	//	Loop through fields
		$field.each(function()
		{
			checkTranslation($(this));
		});
	});
});