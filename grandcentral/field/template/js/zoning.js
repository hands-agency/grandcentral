$(document).ready(function () {
/*********************************************************************************************
/**	* Multiple
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('.zoning').multipleselect({		
		app:'field',
		theme:'default',
		template:'zoning.available',
	});

/*********************************************************************************************
/**	* Popup
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$('.zoning .selected li .title').popup(
	{
		app: 'field',
		theme: 'default',
		template: 'zoning.config',
		width:'60%',
		handled_app: ''+$(this).parent().find('input').val()+'',
	});
});