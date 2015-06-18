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
/**	* Asleep / live
 	* @author	@mvdandrieux
**#******************************************************************************************/
	$(document).on('click', '.action .asleep, .action .live', function()
	{
	//	Some vars
		$item = $(this).closest('li');
		item = $item.data('item');
		live = $item.data('live');
		$card = $item.find('.card');
		$back = $card.find('.back');

	//	Change live status
		$.ajx(
		{
			app: 'content',
			template: '/master/live',
			mime:'json',
			item:item,
			live:live,
		}, {
		//	Done
			done:function()
			{
			//	Change the display
				$item.attr('data-live', live).data('live', live);
			}
		});
	});

/*********************************************************************************************
/**	* Focus on search engine
 	* @author	@mvdandrieux
**#******************************************************************************************/
$('#refine input').focus();