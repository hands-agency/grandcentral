(function($)
{
/*
	Simple Image Block
*/

SirTrevor.Blocks.Imagegc = SirTrevor.Block.extend({
	
	type: "imagegc",
	title: function() { return i18n.t('blocks:image:title'); },
	
	droppable: false,
	uploadable: false,
	
	icon_name: 'image',
		
	editorHTML: function() {
      return '<div class="st-image-block" contenteditable="false"><ol class="data"><li class="upload" data-feathericon="&#xe010"></li></ol></div>';
    },
		
	loadData: function(data){
		// Create our image tag
		// this.$editor.html($('<img>', { src: data.file.url }));
	},
	
	onBlockRender: function(){
		/* Open the context */
		var upload = this.$editor.find('li.upload');
		// 	Create zone draggable
		upload.droppable(
		{
			hoverClass:'hover',
			tolerance:'pointer'
		});
		//	Event open context
		upload.click(function()
		{
			openContext(
			{
				app:'media',
				template:'admin'
			});
		})
		
	},
	
	onUploadSuccess : function(data) {
		this.setData(data);
		this.ready();
	},
	
	onUploadError : function(jqXHR, status, errorThrown){
		this.addMessage(i18n.t('blocks:image:upload_error'));
		this.ready();
	},
	
	onDrop: function(transferData){
		console.log(transferData)
	}
});

})(jQuery); 