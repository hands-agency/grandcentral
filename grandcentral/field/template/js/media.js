(function($)
{
//	Our media
	field = $('li[data-type="media"] .wrapper');
	data = field.find('ol.data');
	template = field.find('.template');
	media = data.find('li');
	path = media.find('input').val();
	upload = $('li[data-type="media"] .wrapper ol.data li.upload');
	
//	Upload droppable
	upload.droppable(
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
			code = $(template.html());
		//	Append and enable
			data.prepend(code);
			$(code).show('fast').find('*:disabled').prop('disabled', false);
		//	Add data
			media = ui.helper;
			$(code).find('.preview img').attr('src', media.find('.preview img').attr('src'));
			$(code).find('input').val(media.data('path'));
			$(code).find('.title').html(media.data('title'));
			$(code).find('.info').html(media.data('info'));
		}
	});

//	Edit a media
	media.find('.preview').on('click', function()
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
	upload.on('click', function()
	{
		openContext(
		{
			app:'media',
			template:'admin',
		});	
	});

//	Delete media
	$(document).find(field).on('click', '.delete', function()
	{
		$(this).parent('li').hide('fast', function()
		{
			$(this).remove();
		});
		return false;
	});
	
//	Scroll title
	title = media.find('.title');
	title.hoverIntent(
	{
	    over: function(){$(this).addClass('sliding')},
	    out: function(){$(this).removeClass('sliding')},
	});	
})(jQuery); 