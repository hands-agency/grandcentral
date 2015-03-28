/*********************************************************************************************
/**	* Highlighting checkbox and radio
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', 'section.page ol>li ul li', function()
	{
		input = $(this).find('input');
		if ($(input).is(':checked')) $(this).attr('class', 'on');
		else $(this).attr('class', '')
	});
	
/*********************************************************************************************
/**	* Fields edit
 	* @author	@mvdandrieux
**#******************************************************************************************/
	// $('.unlocked section.page fieldset>ol>li:not(:has(.edit))').live('click', function()
	// {
	// //	Container
	// 	code='<div class="edit"><!-- Welcome Ajax --></div>';
	// //	Edit form
	// 	$(this)
	// 		.append(code)
	// 		.find('.edit').ajx({
	// 			app:'form',
	// 			theme:'default',
	// 			template:'item.field.edit',
	// 		}, false);
	// });
	// $('.unlocked section.form fieldset>ol>li:not(:has(.edit))').live('click', function()
	// {
	// //	Container
	// 	code='<div class="edit"><!-- Welcome Ajax --></div>';
	// //	Edit form
	// 	$(this)
	// 		.append(code)
	// 		.find('.edit').ajx({
	// 			app:'form',
	// 			theme:'default',
	// 			template:'item.fields.edit',
	// 		}, false);
	// });
	