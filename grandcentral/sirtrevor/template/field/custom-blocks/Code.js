SirTrevor.Blocks.Code = SirTrevor.Block.extend({

	type: "code",

	title: function() { return 'Code'; },

	editorHTML: '<pre class="st-required st-text-block" style="text-align: left; font-size: 0.75em;" contenteditable="true"></pre>',

	icon_name: 'quote',

	loadData: function(data){
		this.getTextBlock().html(SirTrevor.toHTML(data.text, this.type));
		// this.$('.js-caption-input').val(data.caption);
	}
});
