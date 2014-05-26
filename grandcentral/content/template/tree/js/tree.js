/*********************************************************************************************
/**	* jQuery Sortable
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(function()
{
	
//	Expand
	$('ol.tree').on('click', '.expand', function()
	{
	//	Some vars
		$page = $(this).closest('.page');
		$children = $childrenContainer.find('li');
		
		$children.toggle('fast');
	});
	
//	Add new page
	$('ol.tree').on('click', '.add', function()
	{
	//	Some vars
		$page = $(this).closest('.page');
		$childrenContainer = $page.next('ol');
		
	//	Find & append the template
		template = $page.closest('[data-item]').clone();
		template.data('item', '');
		template.find('.page').attr('data-type', 'new');
		template.attr('style', 'display:none');
		template.find('.action').html('<a href="">Edit me!</a>');
		template.find('ol').html('');
	
	//	Make some babies!
		$(template).appendTo($childrenContainer).show('fast');
		
	//	And create a draft
		$.ajx(
		{
			app: 'content',
			template: '/master/workflow',
			mime:'json',
			item:'page',
			status:'draft',
		}, {
		//	Done
			done:function()
			{
			//	console.log(txt);
			}
		});
	});
	
//	Edit when hover intent
	$(document).on('click', 'ol.tree .icon .front', function()
	{
		$(this).parent('.icon').addClass('flipped');
	});
	$('ol.tree .icon').hoverIntent(
	{
		timeout: 500,
		over: function() {},
		out: function()
		{
			$(this).removeClass('flipped preview');
		}
	});
	
//	Preview
	$('ol.tree .action').on('click', '.preview', function()
	{
		$page = $(this).closest('.page');
		$icon = $page.find('.icon');
		$back = $icon.find('.back');
		url = $page.data('url');
		
		$icon.addClass('preview');
		$back.find('.preview iframe').attr('src', url);
	});
	
//	Asleep / live
	$('ol.tree .action').on('click', '.asleep, .live', function()
	{
	//	Some vars
		$item = $(this).closest('[data-item]');
		item = $item.data('item');
		$page = $item.children('.page');
		status = $(this).attr('class');
		
	//	Change status
		$.ajx(
		{
			app: 'content',
			template: '/master/status',
			mime:'json',
			item:item,
			status:status,
		}, {
		//	Done
			done:function()
			{
			//	Change the display status
				$page.attr('data-status', status).data('status', status);	
			//	Asleep? Put all kids asleep as well
				if (status == 'asleep')
				{
					$item.find('[data-item]').each(function()
					{
						$(this).find('.asleep').click();
					});
				}
			}
		});
	});

/*********************************************************************************************
/**	* Site tree
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	Start nested sortable
	$(document).bind('unlock', function()
	{
	//	Make sortable	
		$('ol.tree').sortable(
		{
			handle: '.icon',
			items: '> li li[data-item]',
			tolerance:'intersect',
		
		//	On start
			start: function()
			{
			//	Show trash
				$('#trashbin').data('trashbin').show();
			//	Collapse
			
			},
		
		//	On stop
			stop: function()
			{
			//	Hide trash
				$('#trashbin').data('trashbin').hide();
			//	re-expand
		
			},
		});
	});
	
//	Save the curent sitetree
	$(document).bind('lock', function()
	{
		/*
	//	Get the order
		pages = $('ol.sitetree').find('li[data-item]');
		sitetree = Array();
	//	Loop through the pages
		pages.each(function(i)
		{
		//	Get the nickname and the children
			item = $(this).data('item');
			children = Array();
			$(this).find('>ol>li[data-item]').each(function(){children.push($(this).data('item'));});
		//	Store the data
			sitetree[i] = {item:item, children:children};
		});
	//	Send the new order to ajax
		$.ajx(
		{
			app:'section',
			theme:'sitetree',
			template:'/order.routine',
			sitetree:sitetree,
		},
		{
			done:function(html){console.log(html);}
		}
		);
		*/
	});
});