(function($)
{
//	Our media
	$field = $('li[data-type="media"] .wrapper');
	$data = $field.find('ol.data');
	$media = $data.find('li');
	$upload = $('li[data-type="media"] .wrapper ol.data li.upload');
	path = $media.find('input').val();
	
//	Upload droppable
	$upload.droppable(
	{
		hoverClass:'hover',
		tolerance:'pointer',
		activate:function(event, ui)
		{
			
		},
		deactivate:function(event, ui)
		{
		},
		drop:function(event, ui)
		{
	 		template = $(this).closest('.field').find('.template');
			code = $(template.html());
			
		//	Append and enable
			$(this).before(code);
			$(code).show('fast').find('*:disabled').prop('disabled', false);
		//	Add data
			media = ui.helper;
			$(code).attr('title', media.data('title')+' • '+media.data('info'));
			$(code).find('.preview img').attr('src', media.find('.preview img').attr('src'));
			$(code).find('input[name$="[url]"]').val(media.data('path'));
		//	Reorder array
			var i = 0;
			$(this).closest('.data').find('li').each(function()
			{
				$(this).html($(this).html().replace(/\[\]/g, '['+i+']'));
				i++;
			});
		//	Sortable
			$data.sortable();
		}
	});

//	Edit a media
	$media.find('.preview').on('click', function()
	{
	//	Launch
		openContext(
		{
			app:'media',
			template:'admin',
		//	Custom for media library
			path:path,
		});
	});
	
//	Add media
	$upload.on('click', function()
	{
		openContext(
		{
			app:'media',
			template:'admin',
		});	
	});

//	Delete media
	$(document).find($field).on('click', '.delete', function()
	{
		$(this).parent('li').hide('fast', function()
		{
			$(this).remove();
		});
		return false;
	});

//	Sortable
	$data.sortable();
	
})(jQuery); 