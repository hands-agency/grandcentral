SirTrevor.Blocks.Image = SirTrevor.Block.extend(
{
	type: 'image',
	
	title: function() {return i18n.t('blocks:image:title');},
	
	icon_name: 'image',
	feathericon_name: '010',
		
	editorHTML: function()
	{
		return '<pre class="template"><li><button class="delete"></button><a><span class="preview"><img src="" /></span><span class="title"></span></a><input type="hidden" name="url" disabled="disabled" /><input type="hidden" name="title" disabled="disabled" /></li></pre><ol class="data"><li class="upload"></li>';
    },

	loadData: function(data)
	{
		// console.log(SirTrevor)
	//	Some vars
		$editor = this.$editor;
		$data = this.$('.data');
		$upload = this.$('.upload');
		$template = this.$('.template');
		thumbnailWidth = 120;
		
	//	Print stored images
		$(data).each(function()
		{
		//	Template
			code = $($template.html());
		//	Append and enable
			$upload.before(code);
			$(code).find('*:disabled').prop('disabled', false);
		//	Add data
			media = data;
			thumbnail = '/www/'+SITE_KEY+'/cache/media/thumbnail_w'+thumbnailWidth+'_h'+media.url;
			$(code).find('.preview img').attr('src', thumbnail);
			$(code).find('input').val(media.url);
			$(code).find('.title').html(media.title);
		});
	},
	
	onBlockRender: function()
	{
	//	Some vars
		$data = this.$('.data');
		$upload = this.$('.upload');
		$template = this.$('.template');
		
	// 	Create zone draggable
		$upload.droppable(
		{
			hoverClass:'hover',
			tolerance:'pointer',
			drop:function(event, ui)
			{
			//	Template
				code = $($template.html());
			//	Append and enable
				$(this).before(code);
				$(code).show('fast').find('*:disabled').prop('disabled', false);
			//	Add data
				media = ui.helper;
				$(code).find('.preview img').attr('src', media.find('.preview img').attr('src'));
				$(code).find('input').val(media.data('path'));
				$(code).find('.title').html(media.data('title'));
			}
		});
		
	//	Open context for upload
		$upload.click(function()
		{
			openContext(
			{
				app:'media',
				template:'admin'
			});
		})	

	//	Delete media
		$(document).find($data).on('click', '.delete', function()
		{
			$(this).parent('li').hide('fast', function()
			{
				$(this).remove();
			});
			return false;
		});
	},
});