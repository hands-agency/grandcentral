/*********************************************************************************************
/**	* On unlock
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).bind('unlock', function()
{
//	DRAGGABLE : Make the line draggable
	$('section>div>ol>li')
		.draggable(
		{
			revert: 'invalid',
			helper: 'clone',
			cursorAt: { left: 15 },
			start:function()
			{
			//	Show trashbin
				$('#trashbin').data('trashbin').toggle();
			},
			stop:function()
			{
			//	Hide trashbin
				$('#trashbin').data('trashbin').toggle();
			}
		});
});

/*********************************************************************************************
/**	* On unlock
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).on('click', '#options_drop li[data-value]', function()
	{
		order = $(this).data('value');
		$('#tabs li.on').trigger('click');
	});