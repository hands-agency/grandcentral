(function($)
{
//	Our media
	field = $('li[data-type="media"] .wrapper');
	data = field.find('ol.data');
	template = field.find('.template');
	media = data.find('li');
	path = media.find('input').val();
	upload = $('li[data-type="media"] .wrapper ol.data li.upload');

//	Edit a media
	media.find('.preview').on('click', function()
	{
	//	Launch
		$(this).popup(
		{
			app:'media',
			theme:'admin',
			template:'admin',
			width:'98%',
			top:10,
		//	Custom for media library
			path:path
		});
	});
	
//	Add media
	upload.on('click', function()
	{
		$(this).popup(
		{
			app:'media',
			theme:'admin',
			template:'admin',
			width:'98%',
			top:10,
			onSelect:'selectMedia',
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
	
//	Select Media from media library
	selectMedia = function(params)
	{
		code = $(template.html());
	//	Append and enable
		data.prepend(code);
		$(code).show('fast').find('*:disabled').prop('disabled', false);
	//	Add data
		$(code).find('.preview img').attr('src', params.thumbnail);
		$(code).find('input').val(params.path);
		$(code).find('.title').html(params.file);
		$(code).find('.info').html('truc machin');
	//	Hide popup
		upload.data('popup').hide();
	}
	
//	Scroll title
	title = media.find('.title');
	title.hoverIntent(
	{
	    over: function(){$(this).addClass('sliding')},
	    out: function(){$(this).removeClass('sliding')},
	});	
})(jQuery); 