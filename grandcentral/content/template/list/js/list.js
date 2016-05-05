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
/**	* Preview
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '.action .preview', function()
	{
	//	Some vars
		$item = $(this).closest('li');
		$card = $item.find('.card');
		$back = $card.find('.back');
		url = $item.data('url');

		$card.addClass('preview');
		$back.find('.preview iframe').attr('src', url);
	});

/*********************************************************************************************
/**	* Asleep / live / trash
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '.action .asleep, .action .live, .action .trash', function()
	{
	//	Some vars
		$item = $(this).closest('li');
		item = $item.data('item');
		status = $(this).attr('class');
	//	live = $item.data('live'); /* #4.3 */
		$card = $item.find('.card');
		$back = $card.find('.back');
	//	Change live status
		$.ajx(
		{
			app: 'content',
			template: '/master/live',
			mime:'json',
			item:item,
		//	live:live, /* #4.3 */
			status:status,
		}, {
		//	Done
			done:function()
			{
				// console.log(status);
			//	Change the display
			//	$item.attr('data-live', live).data('live', live);/* #4.3 */
				$item.attr('data-status', status).data('status', status);
			//	Detroy trash
				if (status == 'trash') setTimeout(function(){$item.remove()},100);
			},
			fail:function()
			{
				console.log('error');
			}
		});
	});

/*********************************************************************************************
/**	* Focus on search engine
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$('#refine input').focus();
