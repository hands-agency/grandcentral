/*********************************************************************************************
/**	* On unlock
 	* @author	@mvdandrieux
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
/**	* Focus on search engine
 	* @author	@mvdandrieux
**#******************************************************************************************/
$('#refine input').focus();