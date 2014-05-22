/*********************************************************************************************
/**	* jQuery Sortable
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(function()
{
/*	
	$('ol.tree').sortable(
	{
		handle: '.icon',
		items: '> li li[data-item]',
		tolerance:'intersect',
		
	//	On start
		start: function()
		{
		//	Collapse
			
		},
		
	//	On stop
		stop: function()
		{
		//	re-expand
		
		},
	});
*/
	
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
		
	//	Find the template
		template = $page.closest('[data-item]')[0].outerHTML;
	
	//	Make some babies!
		$(template).appendTo($childrenContainer);
	});
	
//	Edit
//	When hover intent
	var config = {
		timeout: 500,
		over: function()
		{
			$(this).addClass('flipped');
		},
		out: function()
		{
			$(this).removeClass('flipped preview');
		}
	};
	$('ol.tree').find('.icon').hoverIntent( config );
	
//	Preview
	$('ol.tree .action').on('click', '.preview', function()
	{
		$page = $(this).closest('.page');
		$icon = $page.find('.icon');
		$back = $icon.find('.back');
		
		$icon.addClass('preview');
		$back.html('<iframe src="'+SITE_URL+'"></iframe>');
	});
	
//	Asleep / live
	$('ol.tree .action').on('click', '.asleep, .live', function()
	{
	//	Some vars
		$item = $(this).closest('[data-item]');
		item = $item.data('item');
		$page = $item.find('.page');
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
			}
		});
	});
});

/*********************************************************************************************
/**	* Site tree
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
//	Start nested sortable
/*	$(document).bind('unlock', function()
	{
		console.log('nested sortable !');
		$('ol.tree').nestedSortable(
		{
			handle: '.icon',
            items: 'li',
			toleranceElement: '>div',
			helper:	'clone',
			opacity: .6,
			placeholder: 'placeholder',
			protectRoot: true,
			revert: 250,
			tolerance: 'pointer',
			isTree: true,
			update: function(event, ui)
			{
			//	Reorder the keys visualy
				parentLevel = $(this).data().sortable.currentItem.closest('ol');
				parent = parentLevel.closest('li');
				parentKey = parent.find('.icon').html();
			//	Haaa, The home page!
				if (parentKey == '0') parentKey = '';
				else parentKey += '.';
			//	
				siblings = parentLevel.find('>li>*>.icon');
				i = 1;
				siblings.each(function()
				{
					$(this).html(parentKey+i);
					i++;
				});
			}
		});
	});
	*/
	
//	Save the curent sitetree
	$(document).bind('lock', function()
	{
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
	});

(function ($) {
	
/*
	$('.disclose').on('click', function() {
		$(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
	})
	
	$('#serialize').click(function(){
			serialized = $('ol.sitetree').nestedSortable('serialize');
			$('#serializeOutput').text(serialized+'\n\n');
		})
	$('#toHierarchy').click(function(e){
			hiered = $('ol.sitetree').nestedSortable('toHierarchy', {startDepthCount: 0});
			hiered = dump(hiered);
			(typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
			$('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
		})

		$('#toArray').click(function(e){
			arraied = $('ol.sitetree').nestedSortable('toArray', {startDepthCount: 0});
			arraied = dump(arraied);
			(typeof($('#toArrayOutput')[0].textContent) != 'undefined') ?
			$('#toArrayOutput')[0].textContent = arraied : $('#toArrayOutput')[0].innerText = arraied;
		})
	function dump(arr,level) {
		var dumped_text = "";
		if(!level) level = 0;

		//The padding given at the beginning of the line.
		var level_padding = "";
		for(var j=0;j<level+1;j++) level_padding += "    ";

		if(typeof(arr) == 'object') { //Array/Hashes/Objects
			for(var item in arr) {
				var value = arr[item];

				if(typeof(value) == 'object') { //If it is an array,
					dumped_text += level_padding + "'" + item + "' ...\n";
					dumped_text += dump(value,level+1);
				} else {
					dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
				}
			}
		} else { //Strings/Chars/Numbers etc.
			dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
		}
		return dumped_text;
	}
*/
})(jQuery);