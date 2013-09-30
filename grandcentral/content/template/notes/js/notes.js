/*********************************************************************************************
/**	* Submit note form via the "Return" key
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).off('keypress', '.noteForm form textarea').on('keypress', '.noteForm form textarea', function(e)
{	
//	On "Return" key
	var key = (e.keyCode ? e.keyCode : e.which);
	if (key == 13)
	{
	//	Some vars
		textarea = $(this);
		form = $(this).closest('form');
		mentions = form.find('.mentions');
		list = form.parent().prev('ul');

	//	Some data
		dataMentions = null;
		textarea.mentionsInput('getMentions', function(data)
		{
			if (data.length) dataMentions = data;
		});

	//	Submit form	
		$.ajax(
		{
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			beforeSend: function()
			{
			//	Prevent writing
				textarea.attr('disabled','disabled');
				$('<li class="loading" style="display:none"><progress value="00" max="100"></progress></li>').appendTo(list).slideDown('fast');
			//	Loading
				list.find('.loading progress').loading();
			},
			success: function(result)
			{
			//	DEBUG
			//	console.log(dataMentions);
			
			//	Start event source (TODO Not the best way to retrieve data we already have...)
				item = form.find('[name="inline_note[item]"]').val();
				itemid = form.find('[name="inline_note[itemid]"]').val();
				StartEventSource(list, item, itemid);
				
			//	Start fresh for next time
				textarea.val('').attr('disabled', null).trigger('autosize');
				mentions.html('<div></div>');
			}
		});
		
	//	Prevent line-breaks
		return false;
	}
});

/*********************************************************************************************
/**	* Delete notes
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$(document).on('click', 'ul.notes .option button.delete', function()
{
//	Our item's nickname
	li = $(this).parents('li[data-item]');
	item = li.data('item');
	
//	Go to trash
	$(this).ajx({
		app: 'page',
		theme: 'default',
		template: 'status',
		type: 'routine',
		item:item,
		status:'archive',
	}, {
	//	Done
		done:function()
		{
			li.hide('fast');
		}
	});
});

/*********************************************************************************************
/**	* Mentions
* @author	mvd@cafecentral.fr
**#******************************************************************************************/
$('section .noteForm form textarea').mentionsInput(
{
	onDataRequest:function (mode, query, callback)
	{
		$.getJSON(ADMIN_ROOT+'/api-json?app=jquery.mentionsInput&theme=default&template=data', function(responseData)
		{
			responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
			callback.call(this, responseData);
		});
	}
});