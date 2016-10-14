(function($)
{
//	Some vars
	$field = $('li[data-type="media"] .wrapper');
	$data = $field.find('ol.data');
	$media = $data.find('li');
	$upload = $('li[data-type="media"] .wrapper ol.data');
	add = 'li[data-type="media"] .wrapper .add, li[data-type="media"] ol.data:empty';
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
		//	Some vars
	 		template = $(this).closest('.field').find('.template');
			code = $(template.html());

		//	TODO Prevent Self droppable

		//	Append and enable
			$(this).append(code);
			$(code).show('fast').find('*:disabled').prop('disabled', false);
		//	Add data
			media = ui.helper;
			$(code).attr('title', media.data('title')+' • '+media.data('info'));
			$(code).find('.preview img').attr('src', media.attr('data-url'));
			$(code).find('input[name$="[url]"]').val(media.data('path'));
		//	Reorder array
			var i = 0;
			$(this).closest('.data').find('li').each(function()
			{
				$(this).html($(this).html().replace(/\[[0-9]*\]/g, '['+ i++ +']'));
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
	$(document).on('click', add, function()
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
	//	Some vars
		$siblings = $(this).parents('.data');
	//	Hide and delete
		$(this).parent('li').hide('fast', function()
		{
		//	Kill
			$(this).remove();
		//	Make sure the data is completely empty to reach the nodata state
			if ($siblings.children().length == 0) $siblings.html('');
		});
		return false;
	});

//	Sortable
	$data.sortable();

})(jQuery);
