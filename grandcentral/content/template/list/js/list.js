$(function()
{
	$(window).bind('scroll', function(event)
	{
		$('.infiniteScrollWantsMore:in-viewport').trigger('click');
	});
});

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
		$('.tabs .li.on').trigger('click');
	});

/*********************************************************************************************
/**	* On unlock
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
	$(document).ready(function()
	{
		var $container = $('.inmasonry section[data-template="list/list"]>ol');
	//	initialize Masonry after all images have loaded  
		$container.imagesLoaded( function()
		{
			$container.masonry(
			{
				itemSelector: 'li[data-item]',
				gutter: 10,
				isAnimated: true
			});
		});
	});

/*********************************************************************************************
/**	* Display the archives
 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
/*	$('section .flag.archive').live('click', function() {
	//	CODE : The archive list
		code='<ul class="archives flat"></ul>';
	//	APPEND : Create the archive list if it doesn't exist, load it and display it.
		obj = $(this).parents('li');
		if (!$(obj).find('.archives').length) {
			$(obj).append(code);
		}
		$(obj).find('.archives').load(ajx('archive.compare'), function() {
			$(obj).find('.archives').toggle('fast');}
		);
		$(this).toggleClass('on off');
	});
*/