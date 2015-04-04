/*********************************************************************************************
/**	* Submit note form via the "Return" key
* @author	@mvdandrieux
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
	/*	dataMentions = null;
		textarea.mentionsInput('getMentions', function(data)
		{
			if (data.length) dataMentions = data;
		});
		*/

	//	Submit form	
		$.ajax(
		{
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(),
			beforeSend: function()
			{
			//	Prevent further writing
				textarea.attr('disabled','disabled');
			//	Loading
				list.loading();
			},
			success: function(result)
			{
			//	DEBUG
			//	console.log(result);
				
			//	Start fresh for next time
				textarea.val('').attr('disabled', null);
				list.loaded();
			//	mentions.html('<div></div>');
			}
		});
		
	//	Prevent line-breaks
		return false;
	}
});

/*********************************************************************************************
/**	* Delete notes
* @author	@mvdandrieux
**#******************************************************************************************/
$(document).on('click', 'ul.notes .option button.delete', function()
{
//	Our item's nickname
	li = $(this).parents('li[data-item]');
	item = li.data('item');
//	Sens to trashbin
	$('#trashbin').data('trashbin').send(item, function()
	{
		li.hide('fast');
	});
});

/*********************************************************************************************
/**	* Mentions
* @author	@mvdandrieux
**#******************************************************************************************/
/*
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
*/