/*********************************************************************************************
/**	* Multiple select plugin
* 	* @author	mvd@cafecentral.fr
**#******************************************************************************************/
(function($)
{	
//	Plugin
	$.fn.multipleselect = function(param)
	{
	//	Iterate and reformat each matched element	
		return this.each(function()
		{
		//	Shortcut
			var $field = $(this);
			var $available = $field.find('.available');
		//	Hacky var to put up with 'out'
		//	which fires even after receive...
			var received;
			
		//	Ajax parameters
			param = $.extend(param,
			{
				name:$available.data('name'),
				values:$available.data('values'),
				valuestype:$available.data('valuestype'),
			});
			
		//	Make the selected sortable
			$field.find('.selected ol').sortable(
			{
				items:'li:not(.nodata)',
				axis:'y',
				revert: 100,
				placeholder:'placeholder',
				tolerance:'pointer',
				over:function(event, ui)
				{
				//	Always get rid of the nodata
					$(this).find('.nodata').hide();
					received = false;
					$(this).addClass('ui-sortable-hover');
				},
				out:function(event, ui)
				{
				//	Maybe bring back the nodata
					if (received === false) {adjust = -1;}
					else adjust = null;
					nodata($(this).data().sortable.currentItem, adjust);
					$(this).removeClass('ui-sortable-hover');
				},
				receive:function(event, ui)
				{
				//	Test if not present
					li = $(this).data().sortable.currentItem;
					value = li.data('item').split('_')[1];
					count = $field.find('.selected input[value="'+value+'"]').length;

				//	Refuse if item already exists
					if (count > 0)
					{
					//	Hacky way to destroy the new forbidden element
						$(this).data().sortable.currentItem.remove();
					//	And shake your head to say No, No, No...
						$(this).parent().effect('shake', {times:2}, 300);
					}
				//	Accept otherwise
					else
					{
					//	Hide eventual Nodata
						nodata($(this).data().sortable.currentItem);
					//	Add the hidden input which contains the value
						input = '<input type="hidden" name="'+param["name"]+'[]" value="'+value+'" />';
						li.append(input);
						received = true;
					}
		    	}
			});
			
		//	Load the available choices
			$field.find('.available ul.choices').ajx(param,
			{
			//	Callback
				done:function() {resort($field)},
			},{
			//	Option
				debug:false,
				async:true,
			});

		//	Delete a selected
			$field.find('.selected li .delete').live('click', function()
			{
				$(this).parent().hide('slide', { direction: "down" }, 100, function()
				{
				//	Keep a handle before removing, to to find the parents
					tmp = $(this).siblings('.nodata');
					$(this).remove();
				//	Eventually show nodata
					nodata(tmp);
				});
			});
			
		//	Refine on the available choices
			$field.find('.refine input[type="search"]').searchasyoutype(param, $field.find('ul.choices'),
			{
			//	Callback
				done:function(){resort($this)},
			});
		});

	//	Show or hide the nodata LI
		function nodata(item, adjust)
		{
		//	Some vars
			sortable = item.parent();
			count = sortable.children().not('.nodata').not('.placeholder').length;
			if (adjust) {count = count + adjust;}
		//	Toggle
			if (count == 0) sortable.find('.nodata').show();
			else sortable.find('.nodata').hide();
		}
	
	//	Make the available choices draggable and connected to the sortable
		function resort(field)
		{
			field.find('.available ul li').draggable(
			{
				connectToSortable:field.find('.selected ol'),
				helper:'clone',
				revert: 'invalid',
				revertDuration: 100,
				start:function(event, ui)
				{
				//	Make the helper look like the source
					ui.helper.css({
						height:$(this).height(),
						width:$(this).width()
					});
				//	Help buble
					field.find('.cc-bubble').effect('bounce', {distance:'10', times:'2'}, 250).delay(1000).hide('fast');
				//	Hide available
					$(this).hide();
				},
				stop:function(event, ui)
				{
				//	Show the available back
					$(this).show('fast');
				},
			});
		}
	};
})( jQuery );
	
$(document).ready(function ()
{	
//	Go	
	$('[data-type="multipleselect"]').multipleselect({		
		app:'field',
		theme:'default',
		template:'multipleselect.available',
	});
});