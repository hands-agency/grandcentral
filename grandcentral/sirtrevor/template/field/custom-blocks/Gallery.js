SirTrevor.Blocks.Gallery = SirTrevor.Block.extend(
{
	type: 'gallery',
	
	title: function() {
		return 'Gallery';//i18n.t('blocks:gallery:title');
	},
	
	icon_name: 'image',
		
	editorHTML: function()
	{
		return '<pre class="template"><li class="element"><button class="delete"></button><a><span class="preview"><img src="" /></span></a><input type="hidden" name="url" disabled="disabled" /></li></pre><ol class="data"><li class="upload"></li></ol>';
  },

	setData: function(data){
		var $data = this.$('.data');
		this.galleryElements = $data[0].querySelectorAll('li.element')

		var newdata = {}
		this.galleryElements.forEach((el, i) => {
			newdata['url' + i] = $(el).find('input').val();
		})
		// console.log('newdata', newdata);
		this.blockStorage.data = newdata
	},

	loadData: function(data)
	{
		//	Some vars
		var $editor = this.$editor;
		var $data = this.$('.data');
		var $upload = this.$('.upload');
		var $template = this.$('.template');
		var thumbnailWidth = 120;
		
		//	Print stored images
		for (const [key, url] of Object.entries(data)) {
			//	Template
			var code = $($template.html());
			//	Append and enable
			$upload.before(code);
			$(code).find('*:disabled').prop('disabled', false);
			//	Add data
			thumbnail = '/www/'+SITE_KEY+'/cache/media/thumbnail_w'+thumbnailWidth+'_h'+url;
			$(code).find('.preview img').attr('src', thumbnail);
			$(code).find('input').attr('name', key).val(url);
		}
	},
	
	onBlockRender: function()
	{
		//	Some vars
		var $this = this 
		var $data = this.$('.data');
		var $upload = this.$('.upload');
		var $template = this.$('.template');
		
		// 	Create zone draggable
		$upload.droppable(
		{
			hoverClass:'hover',
			tolerance:'pointer',
			drop:function(event, ui)
			{
			//	Template
				code = $($template.html());
			//	get the number of items
				this.galleryElements = $data[0].querySelectorAll('li.element')
				this.galleryElements.forEach((el, i) => {
					$(el).find('input').attr('name', 'url' + i)
				})
				$(code).find('input').attr('name', 'url' + this.galleryElements.length)
			//	Append and enable
				$(this).before(code);
				$(code).show('fast').find('*:disabled').prop('disabled', false);
			//	Add data
				media = ui.helper;
				$(code).find('.preview img').attr('src', media.find('.preview').attr('style').slice(22, -3));
				$(code).find('input').val(media.data('path'));
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
		$data.on('click', '.delete', function()
		{
			var $data = $(this).closest('ol.data')
			$(this).parent('li').hide('fast', function()
			{
				$(this).remove();
			});

			setTimeout(() => {
				$data.find('li.element:visible').each(function(i){
					console.log(this)
					$(this).filter(":visible").find('input').attr('name', 'url' + i)
				});
			}, 200)

			$this.setData()
			return false;
		});
	},
});